<!DOCTYPE HTML>
<html lang="<?php echo LANGUAGE; ?>" class="<?php echo $documentClasses; ?>">
<?php $this->inc('elements/head.php'); ?>
<body class="<?php echo $templateHandle; ?>">

    <main class="<?php echo $c->getPageWrapperClass(); ?>">

        <section id="intro">
            <div class="tabular">
                <div class="cellular text-center">
                    <?php $this->inc('../../images/crest.svg'); ?>
                    <h1>Smashing Since 1990</h1>
                    <nav main-nav>
                        <a trigger><i class="icon-bars"></i></a>
                        <ul>
                            <li class="visible-on-dock"><a href="#intro">JHMRFC</a></li>
                            <li><a href="#the-club">The Club</a></li>
                            <li><a href="#calendar">Calendar</a></li>
                            <li><a href="#legacy">Legacy</a></li>
                            <li><a href="#officers">Coaches &amp; Officers</a></li>
                            <li><a href="#media">Media</a></li>
                            <li><a href="#contact">Contact</a></li>
                        </ul>
                    </nav>

                    <div class="quick-contact">
                        <a href="mailto:jhmooserugby@gmail.com"><span>Men</span> jhmooserugby@gmail.com</a>
                        <a href="mailto:jhwomensrugby@gmail.com"><span>Women</span> jhwomensrugby@gmail.com</a>
                    </div>
                </div>
            </div>
        </section>

        <section id="the-club">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h2>The Club</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <?php $a = new Area('Main-1'); $a->setAreaGridMaximumColumns(12); $a->display($c); ?>
                    </div>
                </div>
            </div>
        </section>

        <section id="calendar">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h2>Calendar</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <?php $a = new Area('Main-2'); $a->setAreaGridMaximumColumns(12); $a->display($c); ?>
                    </div>
                </div>
            </div>
        </section>

        <section id="legacy">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h2>Legacy</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <?php $a = new Area('Main-3'); $a->setAreaGridMaximumColumns(12); $a->display($c); ?>
                    </div>
                </div>
            </div>
        </section>

        <section id="officers">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h2>Officers &amp; Coaches</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <?php $a = new Area('Main-4'); $a->setAreaGridMaximumColumns(12); $a->display($c); ?>
                    </div>
                </div>
            </div>
        </section>

        <section id="media">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h2>Media</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <?php $a = new Area('Main-5'); $a->setAreaGridMaximumColumns(12); $a->display($c); ?>
                    </div>
                </div>
            </div>
        </section>

        <section id="contact">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h2>Contact</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <?php $a = new Area('Main-6'); $a->setAreaGridMaximumColumns(12); $a->display($c); ?>
                    </div>
                </div>
            </div>
        </section>

<!--        <section id="locations" style="height:100%;">-->
<!--            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d1582.754007893033!2d-110.75775364868761!3d43.481194414638374!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e1!3m2!1sen!2sus!4v1444376315981" width="100%" height="50%" frameborder="0" style="border:0" allowfullscreen></iframe>-->
<!--            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d2100.490128750359!2d-111.0450227638058!3d43.17907124084686!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e1!3m2!1sen!2sus!4v1444375993856" width="100%" height="50%" frameborder="0" style="border:0" allowfullscreen></iframe>-->
<!--        </section>-->

    </main>

<?php Loader::element('footer_required'); // REQUIRED BY C5 // ?>
</body>
</html>