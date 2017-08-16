<?php

namespace Sioen\JsonToHtml;

final class CarouselConverter implements Converter
{
    public function toHtml(array $data)
    {
        $data = $data["carousel"];
        $html = '';

        if (count($data) > 3){ // minimum item requirement for desktop is 4 elements.
            $html .= '<div class="carousel-wrapper" id="carousel-'.$data["id"].'">';

            if(isset($data["title"])) {
                $html .=     '<h3 class="carousel-title">'.$data["title"].'</h3>';
            }
            if(isset($data["description"])) {
                $html .=     '<p class="carousel-description">'.$data["description"].'</p>';
            }
            $html .= '<div class="carousel-items col-xs-12" id="carousel-items-'.$data["id"].'">';

            foreach ($data["items"] as $key => $value) {
                $html .= '  <div class="carousel-item">';
                $html .= '      <img src="'.$value["image"].'" alt="'.$value["title"].'" class="img-responsive carousel-image">';
                if(isset($value["body"])) {
                    $html .=    '<p class="carousel-body">'.$value["body"].'</p>';
                }
                $html .= '      <hr class="carousel-separator"/>';
                $html .= '  </div>';
            }
            $html .= '</div></div>';
            $html .= '<script type="text/javascript">
                          $( document ).ready(function() {
                            var params = {
                              infinite: true,
                              dots: false,
                              slidesToShow: 3,
                              slidesToScroll: 3,
                              autoplay: true,
                              arrows: true,
                              autoplaySpeed: 8000,
                              responsive: [
                                  {
                                      breakpoint: 1380,
                                      settings: {
                                          slidesToShow: 3,
                                          slidesToScroll: 3
                                      }
                                  },
                                {
                                  breakpoint: 1024,
                                  settings: {
                                      slidesToShow: 2,
                                      slidesToScroll: 2
                                  }
                                },
                                {
                                  breakpoint: 480,
                                  settings: {
                                    slidesToShow: 1,
                                    slidesToScroll: 1
                                  }
                                }
                              ]
                            }

                            $(\'#carousel-items-'.$data["id"].'\').slick(params);
                          });
                      </script>';
        }
        return $html;
    }

    public function matches($type)
    {
        return $type === 'carousel';
    }
}
