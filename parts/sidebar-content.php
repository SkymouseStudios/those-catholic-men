<?php // This is the sidebar on individual blog posts ?>



<div id='product-component-0a9646a9daa'></div>
<script type="text/javascript">
/*<![CDATA[*/

(function () {
  var scriptURL = 'https://sdks.shopifycdn.com/buy-button/latest/buy-button-storefront.min.js';
  if (window.ShopifyBuy) {
    if (window.ShopifyBuy.UI) {
      ShopifyBuyInit();
    } else {
      loadScript();
    }
  } else {
    loadScript();
  }

  function loadScript() {
    var script = document.createElement('script');
    script.async = true;
    script.src = scriptURL;
    (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(script);
    script.onload = ShopifyBuyInit;
  }

  function ShopifyBuyInit() {
    var client = ShopifyBuy.buildClient({
      domain: 'exodus-90.myshopify.com',
      apiKey: 'a87514f7e14d35248d5902470e9743f1',
      appId: '6',
    });

    ShopifyBuy.UI.onReady(client).then(function (ui) {
      ui.createComponent('product', {
        id: [8758637001],
        node: document.getElementById('product-component-0a9646a9daa'),
        moneyFormat: '%24%7B%7Bamount%7D%7D',
        options: {
  "product": {
    "buttonDestination": "checkout",
    "variantId": "all",
    "contents": {
      "imgWithCarousel": false,
      "variantTitle": false,
      "description": false,
      "buttonWithQuantity": false,
      "quantity": false
    },
    "text": {
      "button": "BUY NOW"
    },
    "styles": {
      "product": {
        "@media (min-width: 601px)": {
          "max-width": "100%",
          "margin-left": "0",
          "margin-bottom": "50px"
        }
      },
      "button": {
        "background-color": "#ff7a00",
        "color": "#fdfdfd",
        "font-size": "15px",
        "padding-top": "15.5px",
        "padding-bottom": "15.5px",
        "padding-left": "19px",
        "padding-right": "19px",
        ":hover": {
          "background-color": "#e66e00",
          "color": "#fdfdfd"
        },
        ":focus": {
          "background-color": "#e66e00"
        }
      },
      "title": {
        "color": "#ffffff"
      },
      "price": {
        "color": "#ffffff"
      },
      "quantityInput": {
        "font-size": "15px",
        "padding-top": "15.5px",
        "padding-bottom": "15.5px"
      },
      "compareAt": {
        "font-size": "12px",
        "color": "#ffffff"
      }
    }
  },
  "cart": {
    "contents": {
      "button": true
    },
    "styles": {
      "button": {
        "background-color": "#ff7a00",
        "color": "#fdfdfd",
        "font-size": "15px",
        "padding-top": "15.5px",
        "padding-bottom": "15.5px",
        ":hover": {
          "background-color": "#e66e00",
          "color": "#fdfdfd"
        },
        ":focus": {
          "background-color": "#e66e00"
        }
      },
      "footer": {
        "background-color": "#ffffff"
      }
    }
  },
  "modalProduct": {
    "contents": {
      "img": false,
      "imgWithCarousel": true,
      "variantTitle": false,
      "buttonWithQuantity": true,
      "button": false,
      "quantity": false
    },
    "styles": {
      "product": {
        "@media (min-width: 601px)": {
          "max-width": "100%",
          "margin-left": "0px",
          "margin-bottom": "0px"
        }
      },
      "button": {
        "background-color": "#ff7a00",
        "color": "#fdfdfd",
        "font-size": "15px",
        "padding-top": "15.5px",
        "padding-bottom": "15.5px",
        "padding-left": "19px",
        "padding-right": "19px",
        ":hover": {
          "background-color": "#e66e00",
          "color": "#fdfdfd"
        },
        ":focus": {
          "background-color": "#e66e00"
        }
      },
      "quantityInput": {
        "font-size": "15px",
        "padding-top": "15.5px",
        "padding-bottom": "15.5px"
      }
    }
  },
  "toggle": {
    "styles": {
      "toggle": {
        "background-color": "#ff7a00",
        ":hover": {
          "background-color": "#e66e00"
        },
        ":focus": {
          "background-color": "#e66e00"
        }
      },
      "count": {
        "font-size": "15px",
        "color": "#fdfdfd",
        ":hover": {
          "color": "#fdfdfd"
        }
      },
      "iconPath": {
        "fill": "#fdfdfd"
      }
    }
  },
  "productSet": {
    "styles": {
      "products": {
        "@media (min-width: 601px)": {
          "margin-left": "-20px"
        }
      }
    }
  }
}
      });
    });
  }
})();
/*]]>*/
</script>
<p>
</p>
<p>
</p>

<p style="padding: 10px; font: 16px gotham_promedium,sans-serif; line-height: 30px;">
On the go? Subscribe to the <a style="color: white; text-decoration:underline;" href="https://pinecast.com/feed/those-catholic-men">RSS Feed</a> of our audio blog or...
</p>
<div class="itunes">
	<a href="https://itunes.apple.com/us/podcast/those-catholic-men/id1340543443?mt=2"><img style="width:100%;" src="http://thosecatholicmen.com/wp-content/uploads/2018/01/itunes-retina.png" alt="Subscribe on itunes"></a>
</div>

<div class="social-plugin" style="margin-top:0px;">
                            <!--Facebook widget-->
                            <div id="fb-root"></div>
                            <script>(function(d, s, id) {
                              var js, fjs = d.getElementsByTagName(s)[0];
                              if (d.getElementById(id)) return;
                              js = d.createElement(s); js.id = id;
                              js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4";
                              fjs.parentNode.insertBefore(js, fjs);
                            }(document, 'script', 'facebook-jssdk'));</script>

                            <?php
                                $info = get_option('info_site_name');
                                echo $info['facebook'];
                            ?>
                            <!--Facebook widget-->
                        </div>

<div class="subscribe">
    <h3>Get Our Newsletter</h3>
    <?php echo do_shortcode('[mc4wp_form id="127"]'); ?>
</div>

<div class="exodus">

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
                    <p><?php echo get_the_title();//do_excerpt(get_the_title(), 25); ?></p>
                    <span class="date"><?php the_time('m d Y') ?></span>
                </a>
            </li>
        <?php
        endwhile;
        wp_reset_postdata();
        ?>
    </ul>
</div>

 <div class="exodus90">
	<a href="https://exodus90.com/" target="_blank"><img src="http://thosecatholicmen.com/wp-content/uploads/2018/01/unnamed-3.png" alt="You are not a weak man. Join Exodus." /></a>
</div>