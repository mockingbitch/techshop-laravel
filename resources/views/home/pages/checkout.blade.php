@extends('home.homepage')
@section('content')
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <form action="" method="POST">

                    <div class="col-md-7">
                        <!-- Billing Details -->
                        <div class="billing-details">
                            <div class="section-title">
                                <h3 class="title">Thông tin nhận hàng</h3>
                            </div>
                            <?php
                            if (isset($_SESSION['username'])){
                            ?>
                            <div class="form-group">
                                <input class="input" type="text" name="customername" value="<?= $_SESSION['fullname'] ?>">
                            </div>
                            <div class="form-group">
                                <input class="input" type="email" name="email" value="<?= $_SESSION['usermail'] ?>">
                            </div>
                            <div class="form-group">
                                <input class="input" type="text" name="city" placeholder="Tỉnh/Thành phố">
                            </div>
                            <div class="form-group">
                                <input class="input" type="text" name="addressdetail" placeholder="Đường / Xã / Quận">
                            </div>
                            <div class="form-group">
                                <input class="input" type="tel" name="sdt" value="<?= $_SESSION['phone'] ?>">
                            </div>
                            <!-- Order notes -->
                            <div class="order-notes">
                                <textarea class="input" name="note" placeholder="Ghi chú"></textarea>
                            </div>
                            <!-- /Order notes -->
                            <?php
                            }
                            else{
                            ?>
                            <h3>Vui lòng <a href="login.php" style=" font-weight: bold">đăng nhập</a> để tiếp tục.</h3>
                            <?php
                            }
                            ?>
                        </div>



                    </div>

                    <!-- Order Details -->
                    <div class="col-md-5 order-details">
                        <div class="section-title text-center">
                            <h3 class="title">Đơn hàng của bạn</h3>
                        </div>

                        <div class="order-summary">
                            <div class="order-col">
                                <div><strong>Sản phẩm</strong></div>
                                <div><strong>Tổng</strong></div>
                            </div>
                            <?php $subtotal = 0; ?>
                            <?php if (isset($_SESSION['cart'])){
                            ?>
                            <?php foreach ($_SESSION['cart'] as $key => $value): ?>
                            <div class="order-products">
                                <div class="order-col">
                                    <div><?php echo $value['qty'] ?> x <?php echo $value['name'] ?></div>
                                    <div><?php $total = $value['qty']*$value['price'];
                                        echo number_format($total,0,',','.');
                                        ?> Đ</div>
                                </div>
                            </div>
                            <?php $subtotal+=$total; ?>
                            <?php endforeach; ?>
                            <?php
                            }else{
                                echo '<h4 style="color: red">Chưa có sản phẩm nào trong giỏ hàng, vui lòng thêm sản phẩm để tiến hành thanh toán!!!</h4>';
                            }
                            ?>
                            <div class="order-col">
                                <div>Shipping</div>
                                <div><strong>FREE</strong></div>
                            </div>
                            <div class="order-col">
                                <div><strong>Tổng thanh toán</strong></div>
                                <div><strong class="order-total"><?php echo number_format($subtotal,0,',','.');?> Đ</strong></div>
                            </div>
                        </div>
                        <?php
                        if (isset($_SESSION['cart'])){
                        ?>
                        <div class="payment-method">
                            <div class="input-radio">
                                <input type="radio" name="payment" id="payment-1">
                                <label for="payment-1">
                                    <span></span>
                                    Direct Bank Transfer
                                </label>
                                <div class="caption">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                </div>
                            </div>
                            <div class="input-radio">
                                <input type="radio" name="payment" id="payment-2">
                                <label for="payment-2">
                                    <span></span>
                                    Cheque Payment
                                </label>
                                <div class="caption">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                </div>
                            </div>
                            <div class="input-radio">
                                <input type="radio" name="payment" id="payment-3">
                                <label for="payment-3">
                                    <span></span>
                                    Paypal System
                                </label>
                                <div class="caption">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                </div>
                            </div>
                        </div>
                        <div class="input-checkbox">
                            <input type="checkbox" id="terms">
                            <label for="terms">
                                <span></span>
                                I've read and accept the <a href="#">terms & conditions</a>
                            </label>
                        </div>
                        <input class="primary-btn order-submit" type="submit" name="checkout" value="Xác nhận đơn hàng">
                        <?php
                        }
                        ?>
                    </div>
                </form>
                <!-- /Order Details -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
@endsection
