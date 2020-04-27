@extends('layouts.amp')
  @section('main_amp')
 <amp-state id="shirts" [src]="'login-amp/?sku=' + selected.sku">
    <script type="application/json">
      {
        "1001": {
          "color": "black",
          "image": "{{ asset('images/shirts/black.jpg') }}",
          "sizes": {
            "XS": 8.99,
            "S": 9.99
          }
        },
        "1002": {
          "color": "blue",
          "image": "{{ asset('images/shirts/blue.jpg') }}"
        },
        "1010": {
          "color": "brown",
          "image": "{{ asset('images/shirts/brown.jpg')}}"
        },
        "1014": {
          "color": "dark green",
          "image": "{{ asset('images/shirts/dark-green.jpg') }}"
        },
        "1015": {
          "color": "gray",
          "image": "{{ asset('images/shirts/gray.jpg') }}"
        },
        "1016": {
          "color": "light gray",
          "image": "{{ asset('images/shirts/light-gray.jpg') }}"
        },
        "1021": {
          "color": "navy",
          "image": "{{ asset('images/shirts/navy.jpg') }}"
        },
        "1030": {
          "color": "wine",
          "image": "{{ asset('images/shirts/wine.jpg') }}",
          "sizes": {
            "XL": "9.00"
          }
        }
      }
  </script>
</amp-state>

<amp-state id="selected">
  <script type="application/json">
    {
      "slide": 0,
      "sku": "1001"
    }
  </script>
</amp-state>
 
  <header id="header" class="mdl-color--black mdl-color-text--white">
    <amp-img class="menu" src="{{ asset('images/img-icon/ic_menu_white_24dp_1x.png') }}" width=24 height=24></amp-img>
    <span class="mdl-color-text--blue">AMP</span>PAREL
    <amp-img class="search" src="{{ asset('images/img-icon/ic_search_white_24dp_1x.png') }}" width=24 height=24></amp-img>
  </header>

  <div id="container">
    <h5 class="title">MEN'S COTTON CREW NECK<br>LONG SLEEVE T-SHIRT</h5>
    <h6 class="rating"><span class="mdl-color-text--red">★★★★☆</span> <span class="mdl-color-text--grey">(14)</span></h6>

    <amp-carousel type="slides" layout="fixed-height" height=250 id="carousel"
    on="slideChange:AMP.setState({selected: {slide: event.index}})">
      <!-- TODO: "Changing images in amp-carousel" -->
      <amp-img width=200 height=250 src="{{ asset('images/shirts/black.jpg') }}" [src]="shirts[selected.sku].image"></amp-img>
      <amp-img width=300 height=375 src="{{ asset('images/shirts/black.jpg') }}" [src]="shirts[selected.sku].image"></amp-img>
      <amp-img width=400 height=500 src="{{ asset('images/shirts/black.jpg') }}" [src]="shirts[selected.sku].image"></amp-img>
    </amp-carousel>


    <!-- TODO: "Add a slide indicator" -->
    <p class="dots">
      <span [class]="selected.slide == 0 ? 'current' : ''" class="current"></span>
      <span [class]="selected.slide == 1 ? 'current' : ''"></span>
      <span [class]="selected.slide == 2 ? 'current' : ''"></span>
    </p>

    <form method="get" action="{{ url('login-amp')}}" target="_top"  >
      <div class="options colors">
        <h6>COLORS</h6>

        <!--
          Tip: <amp-selector> functions like an <input> element when nested in a <form>.
          @see https://www.ampproject.org/docs/reference/components/amp-form#inputs-and-fields
        -->
        <amp-selector name="color" on="select:AMP.setState({selected: {sku: event.targetOption}})">
          <table>
            <tr>
              <td><amp-img width=40 height=40 option="1001" src="{{ asset('images/shirts/swatch/black.jpg')}}"
                ></amp-img></td>
              <td><amp-img width=40 height=40 option="1002" src="{{ asset('images/shirts/swatch/blue.jpg')}}"></amp-img></td>
              <td><amp-img width=40 height=40 option="1010" src="{{ asset('images/shirts/swatch/brown.jpg')}}"></amp-img></td>
              <td><amp-img width=40 height=40 option="1014" src="{{ asset('images/shirts/swatch/dark-green.jpg')}}"></amp-img></td>
            </tr>
            <tr>
              <td><amp-img width=40 height=40 option="1015" src="{{ asset('images/shirts/swatch/gray.jpg')}}"></amp-img></td>
              <td><amp-img width=40 height=40 option="1016" src="{{ asset('images/shirts/swatch/light-gray.jpg')}}"></amp-img></td>
              <td><amp-img width=40 height=40 option="1021" src="{{ asset('images/shirts/swatch/navy.jpg')}}"></amp-img></td>
              <td><amp-img width=40 height=40 option="1030" src="{{ asset('images/shirts/swatch/wine.jpg')}}"></amp-img></td>
            </tr>
          </table>
        </amp-selector>
      </div>

      <div class="options price">
        <h6>PRICE :
          <!-- TODO: "Variable shirt prices" -->
          <span [text]="shirts[selected.sku].sizes[selectedSize] || '---'">---</span>

        </h6>
      </div>

      <div class="options sizes">
        <h6>SIZE :</h6>
        <!-- TODO: "Variable shirt prices" -->
         <amp-selector name="size" on="select:AMP.setState({selectedSize: event.targetOption})">
          <table>
            <tr>
              <!-- TODO: "Fetching available sizes for a shirt" -->
              <td   
                class="unavailable"
              [class]="shirts[selected.sku].sizes['XS'] ? '' : 'unavailable'">
                <div  option="XS">XS</div>
              </td> 
              <td 
              class="unavailable"
              [class]="shirts[selected.sku].sizes['S'] ? '' : 'unavailable'">
                <div  option="S">S</div>
              </td>
              <!-- TODO: "Fetching available sizes for a shirt" -->
              <td 
              class="unavailable"
              [class]="shirts[selected.sku].sizes['M'] ? '' : 'unavailable'">
                <div option="M">M</div>
              </td>
              <td 
            class="unavailable"
              [class]="shirts[selected.sku].sizes['L'] ? '' : 'unavailable'">
                <div option="L">L</div>
              </td>
              <td 
              class="unavailable"
               [class]="shirts[selected.sku].sizes['XL'] ? '' : 'unavailable'">
                <div option="XL">XL</div>
              </td>
            </tr>
          </table>
        </amp-selector>
      </div>

      <div class="options quantity">
        <h6>QUANTITY :</h6>
        <select name="quantity">
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
        </select>
      </div>

      <div class="options purchase">
            <input type="submit" value="ADD TO CART" disabled
    class="mdl-button mdl-button--raised mdl-button--accent"
    [disabled]="!selectedSize || !shirts[selected.sku].sizes[selectedSize]">
      </div>

      <div submit-success>
        <template type="amp-mustache">Added  shirt(s) to cart!</template>
      </div>
      <div submit-error>
        <template type="amp-mustache">Error adding to cart: </template>
      </div>
    </form>
  </div>
  @endsection



















