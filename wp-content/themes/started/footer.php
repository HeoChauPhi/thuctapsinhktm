        </div>
        <!-- /main content container -->
      </div>
      <!-- /main content -->

      <div class="footer-panel">
        <div class="container">
          <?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-panel')) ?>
        </div>
      </div>

      <!-- footer -->
      <footer class="footer" role="contentinfo">
        <div class="container">
          <!-- copyright -->
          <p class="copyright">
            <!-- &copy; <?php // echo date('Y'); ?> Copyright <?php // bloginfo('name'); ?>. <?php//  _e('Powered by', 'started'); ?>
            <a href="//wordpress.org" title="WordPress">WordPress</a> &amp; <a href="//started.com" title="started">started</a>. -->
            Công ty TNHH KTM - Trường Trung cấp Kinh tế - Tài nguyên và Môi trường. Email: info@thuctapsinhktm.vn. SĐT: 0462690116 - 0422121140.
          </p>
          <!-- /copyright -->
        </div>
      </footer>
      <!-- /footer -->

    </div>
    <!-- /wrapper -->

    <?php wp_footer(); ?>

    <!-- analytics -->
    <script>
    (function(f,i,r,e,s,h,l){i['GoogleAnalyticsObject']=s;f[s]=f[s]||function(){
    (f[s].q=f[s].q||[]).push(arguments)},f[s].l=1*new Date();h=i.createElement(r),
    l=i.getElementsByTagName(r)[0];h.async=1;h.src=e;l.parentNode.insertBefore(h,l)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    ga('create', 'UA-XXXXXXXX-XX', 'yourdomain.com');
    ga('send', 'pageview');
    </script>

  </body>
</html>
