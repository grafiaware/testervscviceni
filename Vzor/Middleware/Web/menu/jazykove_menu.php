<?php
use Psr\Http\Message\ServerRequestInterface;

$langData = [
    'cs'=>['image'=>'grafia/img/cze.gif',
        'alt'=>'Česky'
        ],
    'en'=>['image'=>'grafia/img/eng.gif',
        'alt'=>'English'
        ],
    'de'=>['image'=>'grafia/img/ger.gif',
        'alt'=>'English'
        ],
];

/* @var $request ServerRequestInterface */
$queryParams = $request->getQueryParams();

foreach ($langData as $lCode=>$langItem) {
    $queryParams['language'] = $lCode;
    echo '<a href="index.php?language='. $lCode. '">';
    echo '<img src="'.Middleware\Web\AppContext::getAppPublicDirectory().$langItem['image'].'" '
            .($langCode == $lCode ? 'class="jazyk-on"' : 'class="jazyk-off"')
            . 'alt="'.$langItem['alt'].'"></a> ';
}


