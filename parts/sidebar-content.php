<?php // This is the sidebar on individual blog posts ?>

<div class="itunes">
	<a href="https://itunes.apple.com/us/podcast/those-catholic-men/id1340543443?mt=2" onclick="dataLayer.push({'event': 'itunes-podcast-button'});"><img style="width:100%;" src="https://thosecatholicmen.com/wp-content/uploads/2018/01/itunes-retina.png" alt="Subscribe on itunes"></a>
</div>

<div class="itunes">
<a href='https://playmusic.app.goo.gl/?ibi=com.google.PlayMusic&isi=691797987&ius=googleplaymusic&apn=com.google.android.music&link=https://play.google.com/music/m/Imjtmx62jud7dkt7e2kx3wcwhpu?t%3DThoseCatholicMen.com%26pcampaignid%3DMKT-na-all-co-pr-mu-pod-16' rel='nofollow' onclick="dataLayer.push({'event': 'google-play-podcast-button'});">
    <img style="width:100%;" alt='Get it on Google Play' src='https://play.google.com/intl/en_us/badges/images/generic/en_badge_web_generic.png'/>
</a>
</div>

<div id="amznCharityBanner"><script type="text/javascript">(function() {var iFrame = document.createElement('iframe'); iFrame.style.display = 'none'; iFrame.style.border = "none"; iFrame.width = 310; iFrame.height = 256; iFrame.setAttribute && iFrame.setAttribute('scrolling', 'no'); iFrame.setAttribute('frameborder', '0'); setTimeout(function() {var contents = (iFrame.contentWindow) ? iFrame.contentWindow : (iFrame.contentDocument.document) ? iFrame.contentDocument.document : iFrame.contentDocument; contents.document.open(); contents.document.write(decodeURIComponent("%3Cdiv%20id%3D%22amznCharityBannerInner%22%3E%3Ca%20href%3D%22https%3A%2F%2Fsmile.amazon.com%2Fch%2F47-5273251%22%20target%3D%22_blank%22%3E%3Cdiv%20class%3D%22text%22%20height%3D%22%22%3E%3Cdiv%20class%3D%22support-wrapper%22%3E%3Cdiv%20class%3D%22support%22%20style%3D%22font-size%3A%2025px%3B%20line-height%3A%2028px%3B%20margin-top%3A%201px%3B%20margin-bottom%3A%201px%3B%22%3ESupport%20%3Cspan%20id%3D%22charity-name%22%20style%3D%22display%3A%20inline-block%3B%22%3EThose%20Catholic%20Men%20Inc.%3C%2Fspan%3E%3C%2Fdiv%3E%3C%2Fdiv%3E%3Cp%20class%3D%22when-shop%22%3EWhen%20you%20shop%20at%20%3Cb%3Esmile.amazon.com%2C%3C%2Fb%3E%3C%2Fp%3E%3Cp%20class%3D%22donates%22%3EAmazon%20donates.%3C%2Fp%3E%3C%2Fdiv%3E%3C%2Fa%3E%3C%2Fdiv%3E%3Cstyle%3E%23amznCharityBannerInner%7Bbackground-image%3Aurl(https%3A%2F%2Fm.media-amazon.com%2Fimages%2FG%2F01%2Fx-locale%2Fpaladin%2Fcharitycentral%2Fbanner-background-image._CB309675353_.png)%3Bwidth%3A300px%3Bheight%3A250px%3Bposition%3Arelative%7D%23amznCharityBannerInner%20a%7Bdisplay%3Ablock%3Bwidth%3A100%25%3Bheight%3A100%25%3Bposition%3Arelative%3Bcolor%3A%23000%3Btext-decoration%3Anone%7D.text%7Bposition%3Aabsolute%3Btop%3A20px%3Bleft%3A15px%3Bright%3A15px%3Bbottom%3A100px%7D.support-wrapper%7Boverflow%3Ahidden%3Bmax-height%3A86px%7D.support%7Bfont-family%3AArial%2Csans%3Bfont-weight%3A700%3Bline-height%3A28px%3Bfont-size%3A25px%3Bcolor%3A%23333%3Btext-align%3Acenter%3Bmargin%3A0%3Bpadding%3A0%3Bbackground%3A0%200%7D.when-shop%7Bfont-family%3AArial%2Csans%3Bfont-size%3A15px%3Bfont-weight%3A400%3Bline-height%3A25px%3Bcolor%3A%23333%3Btext-align%3Acenter%3Bmargin%3A0%3Bpadding%3A0%3Bbackground%3A0%200%7D.donates%7Bfont-family%3AArial%2Csans%3Bfont-size%3A15px%3Bfont-weight%3A400%3Bline-height%3A21px%3Bcolor%3A%23333%3Btext-align%3Acenter%3Bmargin%3A0%3Bpadding%3A0%3Bbackground%3A0%200%7D%3C%2Fstyle%3E")); contents.document.close(); iFrame.style.display = 'block';}); document.getElementById('amznCharityBanner').appendChild(iFrame); })(); </script></div>

<div class="border">
    <h3>Become one of <br>Those Catholic Men</h3>
    <div id="promo"></div>
  <div class="new-subscribe">
    <?php echo do_shortcode('[mc4wp_form id="1878"]'); ?>
</div>  
</div>


<div class="popular-posts">
    <h3>Recent Articles</h3>
    <ul>
        <?php
        $articles = new WP_Query(array('post_type' => 'articles', 'orderby' => 'date', 'order' => 'DESC', 'posts_per_page' => 4));
        
        while ($articles->have_posts()) : $articles->the_post();
            $thumb_img = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
            ?>
            <li>
                <img src="<?php echo $thumb_img; ?>" alt="<?php echo get_the_title(); ?>">
                <a href="<?php echo get_the_permalink(); ?>">
                    <p><?php echo get_the_title(); ?></p>
                    <span class="date"><?php the_time('m d Y') ?></span>
                </a>
            </li>
        <?php 
        endwhile; wp_reset_postdata();
        ?>
    </ul>
</div>

 <div class="exodus90">
	<a href="https://exodus90.com/" target="_blank">
    <img src="https://thosecatholicmen.com/wp-content/uploads/2018/01/unnamed-3.png" alt="You are not a weak man. Join Exodus." />
  </a>
</div>