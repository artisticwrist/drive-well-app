<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css" integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick.css"/>
    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick-theme.css"/>
    <link rel="stylesheet" href="../css/scroll.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<style>
nav {
    z-index: 999;
}
</style>

<body>

    <!-- NAVIGATION BAR -->

    @include('components.nav')


    <!-- ABOUT US -->
    <section class="about-uss">
        <!-- <h1 class="header-text hidden-slide" style="text-align: center;">About Calmbird</h1> -->
        <div class="about">
            <div class="about-flex">
                <h1>Our mission and Vision</h1>
                <p>At Calmbird Services, our mission is to empower the youth through innovative solutions in job
                    advertisement, placement, and cultivating essential 21st-century skills. We strive to go beyond
                    conventional approaches, providing a holistic platform for career development. Our vision is a
                    future where every individual, armed with the right skills and opportunities, can shape their
                    destiny.
                </p>
            </div>
            <div class="about-img">
                <img src="./images/bg.jpg" alt="">
            </div>
        </div>
        <div class="about-box">
            <h1 class="hidden-slide head-text">Our Community </h1>
            <p class="sub-head-text">
                Presently boasting over five thousand members, our community is not just a network; <br> It's a support
                system where empowerment and growth converge. We aim to expand this community to one million by the end
                of 2025.
            </p>
            <img src="./images/mockup-iphone-3.svg" alt="" class="about-mockup">
        </div>
        <div class="about">
            <div class="about-img">
                <img src="./images/bg.jpg" alt="">
            </div>
            <div class="about-flex">
                <h1 class="hidden-slide">Identifying A Gap</h1>
                <p>Recognizing the skills gap among job-seeking youths, even those with higher education, fueled our
                    determination to provide a solution.</p>
            </div>
        </div>

    </section>

    <!-- FOOTER -->
    @include('components.footer')

    <script src="./js/scroll.js"></script>
        <script src='js/app.js'></script>
        <script src="js/animate.js"></script>
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js" integrity="sha512-HGOnQO9+SP1V92SrtZfjqxxtLmVzqZpjFFekvzZVWoiASSQgSr4cw9Kqd2+l8Llp4Gm0G8GIFJ4ddwZilcdb8A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
        </script>
</body>

</html>