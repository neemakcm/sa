<input type="hidden" name="product_code" id="product_code" value ="{{$product->product_code}}">

<style>
     .product-col-right .button-group {
    display: flex;
    flex-wrap: wrap;
    justify-content: flex-start;
}
.shopify-buy__layout-vertical .shopify-buy__btn:first-child, .shopify-buy__layout-horizontal .shopify-buy__btn:first-child{
    width: 100%;
}
.shopify-buy__btn {
  padding: 12px;
}
/* .shopify-buy-frame iframe{
    height: 60px !important;
}  */
.shopify-buy-frame--product{
    max-width: none;
    width: 190px;
    display: inline-block;
    margin-right: 20px;
}
.product-col-right .button-group .btn-buy-online, .product-col-right .button-group .btn-visit-store.online_disable {
    margin-right: 0;
}
..shopify-buy__layout-vertical .shopify-buy__btn-wrapper {
    margin-top: 0px !important;
}
@media only screen and (max-width: 991px) {
  .product-col-right .button-group .btn-buy-online, .product-col-right .button-group .btn-visit-store.online_disable {
    margin-right: 20px;
}
}
@media only screen and (max-width: 767px) {
  .product-col-right .button-group .btn-buy-online, .product-col-right .button-group .btn-visit-store {
    width: 47%;
    padding: 4px 10px;
  }
  .shopify-buy-frame--product{
    width: 47%;
    padding: 4px 0px;
  }
  }
  @media only screen and (max-width: 479px) {
    .add_compare{
      width: 100%;
    }
  }


</style>


<div id='product-component-1652414426496'></div>
<script type="text/javascript">
/*<![CDATA[*/
(function () {

  var scriptURL = "{{asset('public/front/script/buy-button-storefront.min.js')}}";
  // var scriptURL = 'https://sdks.shopifycdn.com/buy-button/latest/buy-button-storefront.min.js';
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
      domain: 'impexappliances.myshopify.com',
      storefrontAccessToken: 'fd3ea2ae1966b36d8339c85b3ee46f33',
    });
    ShopifyBuy.UI.onReady(client).then(function (ui) {
        var id = $('#product_code').val();
      ui.createComponent('product', {
        id: id,
        node: document.getElementById('product-component-1652414426496'),
        moneyFormat: 'Rs.%20%7B%7Bamount%7D%7D',
        options: {
  "product": {
    "styles": {
      "product": {
        "@media (min-width: 601px)": {
          "max-width": "calc(25% - 20px)",
          "margin-left": "20px",
          "margin-bottom": "50px"
        }
      },
      "button": {
        "font-size": "16px",
        "font-weight": "600",
        "padding-top": "12px",
        "color": "#000",
        "padding-bottom": "11px",
        "width": "100%",
        ":hover": {
          "background-color": "#000",
          "color": "#fff",
        },
        "background-color": "transparent",
        "border": "1px solid #000",
        ":focus": {
          "background-color": "#000",
          "color": "#fff",
        },
        "border-radius": "27px"
      },
      "quantityInput": {
        "font-size": "14px",
        "padding-top": "15px",
        "padding-bottom": "15px"
      }
    },
    "contents": {
      "img": false,
      "title": false,
      "price": false
    },
    "text": {
      "button": "Add to cart"
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
  },
  "modalProduct": {
    "contents": {
      "img": false,
      "imgWithCarousel": true,
      "button": false,
      "buttonWithQuantity": true
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
        "font-size": "16px",
        "font-weight": "600",
        "padding-top": "12px",
        "padding-bottom": "11px",
        "width": "100%",
        ":hover": {
          "background-color": "#000",
          "color": "#fff",
        },
        "background-color": "transparent",
        "border": "1px solid #000",
        "color": "#000",
        ":focus": {
          "background-color": "#000",
          "color": "#fff",
        },
        "border-radius": "27px"
      },
      "quantityInput": {
        "font-size": "14px",
        "padding-top": "15px",
        "padding-bottom": "15px"
      }
    },
    "text": {
      "button": "Add to cart"
    }
  },
  "option": {},
  "cart": {
    "styles": {
      "button": {
        "font-size": "16px",
        "font-weight": "600",
        "padding-top": "12px",
        "padding-bottom": "11px",
        "width": "100%",
        ":hover": {
          "background-color": "#000",
          "color": "#fff",
        },
        "background-color": "transparent",
        "border": "1px solid #000",
        "color": "#000",
        ":focus": {
          "background-color": "#000",
          "color": "#fff",
        },
        "border-radius": "27px"
      },
      "title": {
        "color": "#000"
      },
      "header": {
        "color": "#000"
      },
      "lineItems": {
        "color": "#000"
      },
      "subtotalText": {
        "color": "#000"
      },
      "subtotal": {
        "color": "#000"
      },
      "notice": {
        "color": "#000"
      },
      "currency": {
        "color": "#000"
      },
      "close": {
        "color": "#000",
        ":hover": {
          "color": "#000"
        }
      },
      "empty": {
        "color": "#000"
      },
      "noteDescription": {
        "color": "#000"
      },
      "discountText": {
        "color": "#000"
      },
      "discountIcon": {
        "fill": "#000"
      },
      "discountAmount": {
        "color": "#000"
      }
    },
    "text": {
      "total": "Subtotal",
      "button": "Checkout"
    }
  },
  "toggle": {
    "styles": {
      "toggle": {
        "background-color": "#000",
        "color": "#fff",
        ":hover": {
          "background-color": "#000"
        },
        ":focus": {
          "background-color": "#000"
        }
      },
      "count": {
        "font-size": "14px"
      }
    }
  },
  "lineItem": {
    "styles": {
      "variantTitle": {
        "color": "#000"
      },
      "title": {
        "color": "#000"
      },
      "price": {
        "color": "#000"
      },
      "fullPrice": {
        "color": "#000"
      },
      "discount": {
        "color": "#000"
      },
      "discountIcon": {
        "fill": "#000"
      },
      "quantity": {
        "color": "#000"
      },
      "quantityIncrement": {
        "color": "#000",
        "border-color": "#000"
      },
      "quantityDecrement": {
        "color": "#000",
        "border-color": "#000"
      },
      "quantityInput": {
        "color": "#000",
        "border-color": "#000"
      }
    }
  }
},
      });
    });
  }
})();
/*]]>*/
</script>
