<?php
echo "
<!DOCTYPE html>
<html lang='en'>

<head>
  <meta charset='utf-8'>

  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <meta http-equiv='X-UA-Compatible' content='ie=edge'>

  $title
  
  <link rel='stylesheet' href='".$site."css/swiper.min.css' media='all and (max-width: 480px)'>

	<link rel='icon' href='".$site."img/favicon.png'>
	<link rel='stylesheet' href='".$site."css/styles.min.css'>
	<link rel='stylesheet' href='".$site."css/style_menu.css'>
	<link rel='stylesheet' href='".$site."css/social.css'>
	<link rel='stylesheet' href='".$site."css/pagination.css'>
	<link rel='stylesheet' href='".$site."css/style_header.css'>
  
  <style>
   .block2 {
    width: 600px;
    padding: 5px;
    border: 0px;
    z-index: 999999;
   }
  </style>
  
</head>

<body>
<div class='cat_header'>
  <svg display='none'>
    <symbol id='illustration' viewBox='0 0 214.72 63.15'>
      <path d='M121.47,21.05h14.75c5.81,0,10.53-4.71,10.53-10.53S142.02,0,136.21,0H26.59
        c-5.81,0-10.53,4.71-10.53,10.53s4.71,10.53,10.53,10.53h48.46c5.81,0,10.53,4.71,10.53,10.53c0,5.81-4.71,10.53-10.53,10.53H58.56
        c-5.81,0-10.53,4.71-10.53,10.53c0,5.81,4.71,10.53,10.53,10.53h68.61c5.81,0,10.53-4.71,10.53-10.53
        c0-5.81-4.71-10.53-10.53-10.53h-5.71c-5.81,0-10.53-4.71-10.53-10.53C110.94,25.76,115.65,21.05,121.47,21.05z' />
      <path d='M214.72,10.93c0,6.04-4.89,10.93-10.93,10.93h-31.47c-6.04,0-10.93-4.89-10.93-10.93l0,0
        c0-6.04,4.89-10.93,10.93-10.93h31.47C209.82,0,214.72,4.89,214.72,10.93L214.72,10.93z' />
      <path d='M32.13,52.63c0,5.81-4.89,10.53-10.93,10.53H10.93C4.89,63.15,0,58.44,0,52.63l0,0
        C0,46.81,4.89,42.1,10.93,42.1H21.2C27.24,42.1,32.13,46.81,32.13,52.63L32.13,52.63z' />
    </symbol>

    <symbol id='close-icon' viewBox='0 0 22 23'>
      <path
        d='M1.362 22.345l-.724-.69 9.42-9.89L.646 2.354l.708-.708 9.393 9.394L20.637.655l.725.69-9.907 10.403 9.899 9.898-.708.708-9.881-9.882z' />
    </symbol>

  </svg>

  <div class='page'>
    <header class='top-header'>
      <div class='container'>
        <div class='top-header__inner'>

          <a href='#' class='logo top-header__logo'>
            <svg version='1.1' class='logo__img' xmlns='http://www.w3.org/2000/svg'
              xmlns:xlink='http://www.w3.org/1999/xlink' x='0px' y='0px' viewBox='0 0 42.36 42.23'
              enable-background='new 0 0 42.36 42.23' xml:space='preserve'>
              <g>
                <circle fill='#FFFFFF' cx='21.11' cy='21.11' r='21.11' class='logo__circle' />
                <g>
                  <defs>
                    <circle id='SVGID_1_' cx='21.25' cy='21.11' r='21.11' />
                  </defs>
                  <clipPath id='SVGID_2_'>
                    <use xlink:href='#SVGID_1_' overflow='visible' />
                  </clipPath>
                  <g clip-path='url(#SVGID_2_)'>
                    <path fill='#1F2224' d='M12.25,8.4c0.29-1.1-9.79,34.57-5.13,44.21c3.54,7.33,24.52,9.66,28.48-0.1s-4.88-45-4.88-45l-5.8,5.03
                  l-6.43,0.37L12.25,8.4z' />
                    <line fill='#FFFFFF' stroke='#FFFFFF' stroke-width='0.5' stroke-miterlimit='10' x1='25.1' y1='24.23'
                      x2='30.83' y2='22.35' />
                    <line fill='#FFFFFF' stroke='#FFFFFF' stroke-width='0.5' stroke-miterlimit='10' x1='25.1' y1='26.23'
                      x2='31.66' y2='25.55' />
                    <line fill='#FFFFFF' stroke='#FFFFFF' stroke-width='0.5' stroke-miterlimit='10' x1='11.39'
                      y1='22.47' x2='17.6' y2='24.14' />
                    <line fill='#FFFFFF' stroke='#FFFFFF' stroke-width='0.5' stroke-miterlimit='10' x1='11.47'
                      y1='25.52' x2='17.71' y2='26.17' />
                    <polygon fill='#FFFFFF' points='26.64,13.25 29.51,10.68 29.91,13.73 			' />
                    <polygon fill='#FFFFFF' points='12.85,13.39 13.2,11.02 16.36,13.39 			' />
                    <polygon fill='#FFFFFF' points='20.06,24.82 22.78,24.82 21.42,26.73 			' />
                  </g>
                </g>
              </g>
            </svg>
          </a>

          <nav class='nav-top top-header__nav'>
            <svg version='1.1' class='nav-top__logo' xmlns='http://www.w3.org/2000/svg'
              xmlns:xlink='http://www.w3.org/1999/xlink' x='0px' y='0px' viewBox='0 0 42.36 42.23'
              enable-background='new 0 0 42.36 42.23' xml:space='preserve'>
              <g>
                <circle fill='#FFFFFF' cx='21.11' cy='21.11' r='21.11' class='nav-top__logo-circle' />
                <g>
                  <defs>
                    <circle id='SVGID_3_' cx='21.25' cy='21.11' r='21.11' />
                  </defs>
                  <clipPath id='SVGID_4_'>
                    <use xlink:href='#SVGID_3_' overflow='visible' />
                  </clipPath>
                  <g clip-path='url(#SVGID_4_)'>
                    <path fill='#1F2224' d='M12.25,8.4c0.29-1.1-9.79,34.57-5.13,44.21c3.54,7.33,24.52,9.66,28.48-0.1s-4.88-45-4.88-45l-5.8,5.03
                  l-6.43,0.37L12.25,8.4z' />
                    <line fill='#FFFFFF' stroke='#FFFFFF' stroke-width='0.5' stroke-miterlimit='10' x1='25.1' y1='24.23'
                      x2='30.83' y2='22.35' />
                    <line fill='#FFFFFF' stroke='#FFFFFF' stroke-width='0.5' stroke-miterlimit='10' x1='25.1' y1='26.23'
                      x2='31.66' y2='25.55' />
                    <line fill='#FFFFFF' stroke='#FFFFFF' stroke-width='0.5' stroke-miterlimit='10' x1='11.39'
                      y1='22.47' x2='17.6' y2='24.14' />
                    <line fill='#FFFFFF' stroke='#FFFFFF' stroke-width='0.5' stroke-miterlimit='10' x1='11.47'
                      y1='25.52' x2='17.71' y2='26.17' />
                    <polygon fill='#FFFFFF' points='26.64,13.25 29.51,10.68 29.91,13.73 			' />
                    <polygon fill='#FFFFFF' points='12.85,13.39 13.2,11.02 16.36,13.39 			' />
                    <polygon fill='#FFFFFF' points='20.06,24.82 22.78,24.82 21.42,26.73 			' />
                  </g>
                </g>
              </g>
            </svg>

            $menu

          </nav>
        </div>
      </div>
    </header>
<center>
    <div class='intro'>
	$header
    </div>
</center>
</div>
    <main class='main'>
";