<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.css">

<style>
    /* Custom Loading Bar Color */
    #nprogress .bar {

        background: #AF8F6F;
        
    }
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.js"></script>

<script>

    NProgress.configure({ showSpinner: false, speed: 500 });

    // Start NProgress when the DOM starts loading
    NProgress.start();

    // Finish NProgress once the page has fully loaded
    window.addEventListener("load", () => {
        NProgress.done();
    });

</script>