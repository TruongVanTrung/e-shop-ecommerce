<?php

namespace App\Http\Controllers;

use App\Mail\MailNotifi;
use App\Models\DetailOrderModel;
use App\Models\OrderModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


class CartController extends Controller
{
    public function index()
    {
        $user = User::find(Auth::user()->id);
        return view('member.cart', ['user' => $user]);
    }
    public function store(Request $request)
    {
        $request->validate(
            [
                'id' => 'required',
                'image' => 'required',
                'price' => 'required',
                'name' => 'required'
            ],
            [
                'required' => 'Bắt buộc'
            ]
        );

        $data = [
            'id' => $request->id,
            'name' => $request->name,
            'image' => $request->image,
            'price' => $request->price,
            'qty' => 1
        ];
        //$request->session()->flush();
        if ($request->session()->has('cart.' . $data['id'])) {
            session()->put('cart.' . $data['id'] . '.qty', session()->get('cart.' . $data['id'] . '.qty') + 1);
        } else {
            session()->put('cart.' . $data['id'], $data);
        }

        if ($request->session()->has('countCart')) {
            session()->put('countCart', session()->get('countCart') + 1);
        } else {
            session()->put('countCart', 1);
        }
        return session()->get('cart');
    }

    public function edit(Request $request)
    {
        $request->validate(
            [
                'id' => 'required',
                'function' => 'required'
            ],
            [
                'required' => 'Bắt buộc'
            ]
        );

        if ($request->function == 1) {
            if ($request->session()->has('countCart')) {
                session()->put('countCart', session()->get('countCart') + 1);
            }

            if ($request->session()->has('cart.' . $request->id)) {
                session()->put('cart.' . $request->id . '.qty', session()->get('cart.' . $request->id . '.qty') + 1);
            }
        } elseif ($request->function == 2) {
            if ($request->session()->has('countCart')) {
                session()->put('countCart', session()->get('countCart') - 1);
            }

            if ($request->session()->has('cart.' . $request->id)) {
                if (session()->get('cart.' . $request->id . '.qty') > 1) {
                    session()->put('cart.' . $request->id . '.qty', session()->get('cart.' . $request->id . '.qty') - 1);
                } elseif (session()->get('cart.' . $request->id . '.qty') == 1) {
                    session()->forget('cart.' . $request->id);
                }
            }
        } elseif ($request->function == 3) {
            if ($request->session()->has('countCart')) {
                session()->put('countCart', session()->get('countCart') - session()->get('cart.' . $request->id . '.qty'));
            }
            if ($request->session()->has('cart.' . $request->id)) {
                session()->forget('cart.' . $request->id);
            }
        }
        return session()->get('cart');
    }

    public function mail()
    {
        $data = [
            'title' => 'Thanh toán đơn hàng',
            'content' => session()->get('cart')
        ];

        Mail::to(Auth::user()->email)->send(new MailNotifi($data));
    }

    public function order(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'address' => 'required',
                'total' => 'required'
            ],
            [
                'required' => 'Bắt buộc'
            ]
        );

        $order  = new OrderModel();

        $order->name = $request->name;
        $order->email = $request->email;
        $order->phone = $request->phone;
        $order->address = $request->address;
        $order->total = $request->total;
        $order->qty =  session()->get('countCart');
        $order->id_user = Auth::user()->id;

        if ($order->save()) {
            $id_order = $order->id;

            foreach (session()->get('cart') as $value) {
                $detail_order = new DetailOrderModel();
                $detail_order->name = $value['name'];
                $detail_order->price = $value['price'];
                $detail_order->qty = $value['qty'];
                $detail_order->id_product = $value['id'];
                $detail_order->id_order = $id_order;
                $detail_order->save();
            }

            $data = [
                'name' => $request->name,
                'email' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
                'total' => $request->total,
                'qty' => session()->get('countCart'),
                'content' => session()->get('cart')
            ];

            Mail::to(Auth::user()->email)->send(new MailNotifi($data));
            session()->forget('cart');
            session()->forget('countCart');
            return redirect('/');
        }
    }
}
