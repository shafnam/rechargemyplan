
<!-- /navigation -->
<header class="{{ Request::is('carriers*', 'login', 'register', 'cart*', 'blog*', 'contact', 'dashboard*') ? 'header-black' : '' }}">
    <div class="row">        
        <div class="logo">
            <a href="/"><img src="{{ URL::asset('/images/recharge-my-plan-logo.png') }}" alt="RechargeMyPlan"></a>
        </div>        
        <nav id="main-nav-wrap">
            <ul class="main-navigation">                    
                <li class="{{ Request::is('/') ? 'highlight' : '' }}">
                    <a href="{{ route('index') }}">Home</a>
                </li>
                <li class="{{ Request::is('carriers') ? 'highlight' : '' }}"><a href="{{ route('carriers') }}" title="Top-Ups">Top Ups</a></li>
                <!--<li><a href="" title="SIM Cards">SIM Cards</a></li>
                <li><a href="" title="Products">Products</a></li>-->
                <li class="{{ Request::is('blog*') ? 'highlight' : '' }}"><a href="{{ route('blog') }}" title="Blog">Blog</a></li>
                <li><a class="{{ Request::is('contact') ? 'highlight' : '' }}" href="{{ route('contact') }}" title="Contact Us">Contact Us</a></li>
            @guest
                <li class="highlight-login">
                    <a name="login" id="loginHeader" href="{{ route('login') }}" style="cursor: pointer; color: #5ec7f1;">
                        Login
                    </a>
                </li>
                <li class="highlight-login">
                    <a name="register" id="registerHeader" href="{{ route('register') }}" style="cursor: pointer; color: #5ec7f1;">
                        Sign-up
                    </a>
                </li>
            @else
                <li class="menu-item-has-children">
                    <a class="username"> 
                        <?php 
                            $fullName = Auth::user()->name; 
                            $nameParts = explode(' ', $fullName);
	                        $firstName = $nameParts[0];
                        ?>
                        hi {{ $firstName }}
                    </a>
                    <ul class="sub-navigation">
                        <li><a href="{{ route('dashboard') }}" class="hvr-forward" title="">My Account</a></li>
                        <li>
                            <a class="nav-link hvr-forward" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                        </li>
                    </ul>
                </li>
                <input type="hidden" name="customer_email" value="<?php //echo $customer_email?>">
                <li>
                    <a href="{{ route('cart') }}" title="cart">
                        <i class="icon ion-ios-cart"></i>
                        <div class="current_item_number">
                            @if(!empty($items))
                                {{ $items->count() }}
                            @else 
                                {{0}}
                            @endif
                        </div>
                    </a>
                </li>
            @endguest
            </ul>
        </nav>        
        <a class="menu-toggle" href="#"><span>Menu</span></a>                
    </div>        
</header> 
<!-- /navigation -->