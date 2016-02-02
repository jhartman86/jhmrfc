<footer>
    <div class="inner">
        <div class="row">
            <div class="col-sm-6 col-md-3">
                <div class="inner-content">
                    <h3>The Center</h3>
                    <address>240 S. Glenwood St.<br/>PO Box 860<br/>Jackson, WY 83001</address>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="inner-content">
                    <h3>Quick Links</h3>
                    <ul class="quick-links">
                        <li><a href="/calendar">Calendar</a></li>
                        <li><i class="icon-circle"></i><a href="/about">About</a></li>
                        <li><i class="icon-circle"></i><a href="/residents">Residents</a></li>
                        <li><i class="icon-circle"></i><a href="/support">Support</a></li>
                        <li><i class="icon-circle"></i><a href="https://18957.blackbaudhosting.com/18957/General-Operating-Account" target="_blank">Donate</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="inner-content">
                    <h3>Socialize</h3>
                    <a class="icon-circle-facebook socialize" target="_blank" href="http://facebook.com/jhcenterforthearts"></a>
                    <a class="icon-circle-twitter socialize" target="_blank" href="http://twitter.com/thecenterjh"></a>
                    <a class="icon-circle-instagram socialize" target="_blank" href="http://instagram.com/thecenterjh"></a>
                    <a class="icon-circle-pinterest socialize" target="_blank" href="http://pinterest.com/thecenterjh"></a>
                    <a class="icon-circle-google-plus socialize" target="_blank" href="https://plus.google.com/113085364394299174338"></a>

                    <script type="text/ng-template" id="tpl/email-list-signup">
                        <form name="_signupForm" id="emailListSignup" class="tabular" ng-submit="doSignup()">
                            <div class="cellular text-center">
                                <div class="block-width" ng-hide="working">
                                    <p>Sign up for the Center For The Arts Newsletter</p>
                                    <div class="custom-row">
                                        <label class="half"><input required ng-model="fields.first" name="first" type="text" class="form-control" placeholder="First Name"/></label>
                                        <label class="half"><input required ng-model="fields.last" name="last" type="text" class="form-control" placeholder="Last Name"/></label>
                                    </div>
                                    <div class="custom-row">
                                        <label><input required ng-model="fields.email" name="email" type="email" class="form-control" placeholder="Email"/></label>
                                    </div>
                                    <div class="custom-row">
                                        <label><input type="submit" class="btn btn-block btn-success" value="Sign Me Up!"/></label>
                                        <label class="text-center"><span ng-click="close()" class="nevermind">Changed My Mind</span></label>
                                    </div>
                                </div>
                                <div class="block-width logo-load-progress" ng-show="working" ng-class="{working:working}">
                                    <?php //$this->inc('../../images/logo-loader.svg'); ?>
                                </div>
                            </div>
                        </form>
                    </script>

                    <span email-list-signup="<?php echo Router::route(array('email_list_signup', 'artsy')); ?>">Sign Up For Our Newsletter</span>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="inner-content">
                    <h3>Get In Touch</h3>
                    <p><b>Main:</b> 307.734.8956<br/>
                        <b>Box Office:</b> 307.733.4900<br/>
                        <a href="mailto:info@jhcenterforthearts.org">info@jhcenterforthearts.org</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <span class="legalese">Copyright &copy; <?php echo date('Y'); ?> Center for the Arts. All Rights Reserved.</span>
</footer>