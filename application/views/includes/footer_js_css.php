
</body>
<script type="text/javascript">
	$(document).ready(function ($) {
    var url = window.location.href;
    var activePage = url;
    $('.nav-item a').each(function () {
        var linkPage = this.href;
        
        if (activePage == linkPage) {
        	$(".nav-item a").removeClass("active");
            $(this).addClass("active");
            $(this).parent().addClass('nav-item menu-is-opening menu-open');
            $(this).parent().parent().css('display', 'block');
            $(this).parent().parent().parent().addClass('menu-is-opening menu-open');
        }
    });
});
</script>
</html>

