<?php
echo '
<div class="cat_footer">
    <footer class="footer page__footer page--profile__footer">
      <div class="container">
        <div class="footer__logo">Minter<span class="footer__logo-dark">Cat</span></div>

        <ul class="social footer__social">

          <li class="social__item">
			<div class="social telegram">
				<a href="https://t.me/MinterCat" target="_blank"><i class="fa fa-paper-plane fa-2x"></i></a>
			</div>
		</li>
          <li class="social__item">
			<div class="social github">
				<a href="https://github.com/MinterCat" target="_blank"><i class="fa fa-github fa-2x"></i></a>
			</div>
          </li>
          <li class="social__item">
			<div class="social vk">
				<a href="https://vk.com/MinterCat" target="_blank"><i class="fa fa-vk fa-2x"></i></a>    
			</div>
          </li>
          <li class="social__item">
            <div class="social twitter">
				<a href="https://twitter.com/MinterCatGame" target="_blank"><i class="fa fa-twitter fa-2x"></i></a>
			</div>
          </li>
        </ul>

        <span class="footer__copyright">' . $language["All_rights_are_registered"] . '</span><br>
		<span class="footer__copyright">
		<a href="'.$site.'dev" target="_blank" class="nav-top__link">API</a> | <a href="'.$site.'pco" target="_blank" class="nav-top__link">PCO</a> | <a href="'.$site.'explorer" target="_blank" class="nav-top__link">Explorer</a>
		</span>

      </div>
    </footer>
</div>
</body>
</html>
';