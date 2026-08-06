@extends('site.layouts.app')

@section('title','Partner Login')

@push('page-styles')

<style>

:root{

--primary:#00A79D;
--primary-dark:#007A73;
--navy:#08233F;
--text:#1F2937;
--muted:#6B7280;
--border:#E5E7EB;
--bg:#F8FAFC;

}

*{

margin:0;
padding:0;
box-sizing:border-box;

}

body{

font-family:'Poppins',sans-serif;
background:#fff;
color:var(--text);

}

.login-hero{

position:relative;
height:420px;
overflow:hidden;

}

.login-hero img{

position:absolute;
inset:0;
width:100%;
height:100%;
object-fit:cover;

}

.login-hero::before{

content:'';
position:absolute;
inset:0;

background:linear-gradient(
90deg,
rgba(8,35,63,.96) 0%,
rgba(8,35,63,.88) 45%,
rgba(8,35,63,.18) 100%
);

z-index:1;

}

.hero-content{

position:relative;
z-index:5;

max-width:1200px;
height:100%;

margin:auto;

display:flex;

align-items:center;

padding:0 20px;

}

.hero-text{

max-width:520px;

color:#fff;

}

.hero-text h1{

font-size:56px;

font-weight:700;

margin-bottom:15px;

}

.hero-text p{

font-size:18px;

line-height:32px;

color:#dbe5ef;

}

.login-wrapper{

position:relative;

margin-top:-110px;

z-index:10;

}

.login-card{

max-width:560px;

margin:auto;

background:#fff;

padding:45px;

border-radius:18px;

box-shadow:

0 25px 70px rgba(0,0,0,.12);

}

.login-card h2{

text-align:center;

font-size:42px;

margin-bottom:8px;

}

.login-sub{

text-align:center;

color:var(--muted);

margin-bottom:35px;

}

.field{

margin-bottom:22px;

}

.field label{

display:block;

margin-bottom:8px;

font-weight:600;

}

.field input{

width:100%;

height:56px;

padding:0 18px;

border:1px solid var(--border);

border-radius:8px;

font-size:15px;

transition:.3s;

}

.field input:focus{

outline:none;

border-color:var(--primary);

}

.password-box{

position:relative;

}

.password-box button{

position:absolute;

right:16px;

top:50%;

transform:translateY(-50%);

border:none;

background:none;

cursor:pointer;

color:#999;

}

.options{

display:flex;

justify-content:space-between;

align-items:center;

margin-bottom:30px;

font-size:15px;

}

.options a{

color:var(--primary);

text-decoration:none;

}

.login-btn{

width:100%;

height:58px;

border:none;

background:var(--primary);

color:#fff;

font-size:18px;

font-weight:700;

border-radius:8px;

cursor:pointer;

transition:.3s;

}

.login-btn:hover{

background:var(--primary-dark);

}

.extra-links{

margin-top:25px;

text-align:center;

font-size:15px;

}

.extra-links p{

margin-bottom:10px;

}

.extra-links a{

color:var(--primary);

text-decoration:none;

font-weight:600;

}

</style>

@endpush

@section('content')

<div class="login-hero">

<img src="https://images.unsplash.com/photo-1558769132-cb1aea458c5e?w=1600&q=80">

<div class="hero-content">

<div class="hero-text">

<h1>Partner Login</h1>

<p>

Access your dashboard to manage orders,
track production,
view updates
and collaborate with Sewgo.

</p>

</div>

</div>

</div>

<div class="container login-wrapper">

<div class="login-card">

<h2>Welcome Back!</h2>

<p class="login-sub">

Log in to your partner account

</p>

@if ($errors->any())

<div class="alert alert-danger">

{{ $errors->first() }}

</div>

@endif

<form method="POST"

action="{{ url('/login') }}">

@csrf

<div class="field">

<label>Email Address</label>

<input

type="email"

name="email"

placeholder="Enter your email"

required>

</div>

<div class="field">

<label>Password</label>

<div class="password-box">

<input

id="pw"

type="password"

name="password"

placeholder="Password"

required>

<button

type="button"

onclick="pw.type=pw.type==='password'?'text':'password'">

<i class="far fa-eye"></i>

</button>

</div>

</div>

<div class="options">

<label>

<input type="checkbox">

Remember me

</label>

<a href="{{ url('/password/reset') }}">

Forgot Password?

</a>

</div>

<button

class="login-btn"

type="submit">

Log In

</button>

<div class="extra-links">

<p>

New Partner?

<a href="{{ url('/contact') }}">

Request Access

</a>

</p>

<p>

<a href="{{ url('/admin/login') }}">

IBA Team Member? Staff Login →

</a>

</p>

</div>

</form>

</div>

</div>