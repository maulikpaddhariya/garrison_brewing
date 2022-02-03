<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       #
 * @since      1.0.0
 *
 * @package    Garrison_brewing
 * @subpackage Garrison_brewing/public/views
 */


class Api_views
{
    public $response;

    public function get_api_html($response_body = '') {
        $html_var = '';

        if($response_body)
        {
            $checkins = $response_body->checkins;
            $html_var .= '<div class="flex flex-wrap -mx-4" style="max-width: 85%;">
                            <div class="w-full px-4">
                                <div class="mb-12 lg:mb-20 max-w-[620px]" style="max-width: 100%;">';

                                    if($response_body->beer_label)
                                    {
                                        $html_var .= '<img src="'.esc_url_raw($response_body->beer_label).'">';
                                    }

                                    if($response_body->beer_name)
                                    {
                                        $html_var .= '<h2 class="font-bold text-3xl sm:text-4xl md:text-[42px] text-dark mb-4">'.sanitize_text_field(__($response_body->beer_name),'garrison_brewing').'</h2>'; 
                                    }

                                    if($response_body->brewery->brewery_name)
                                    {
                                        $html_var .= '<span class="font-semibold text-lg text-primary mb-2 block">
                                                    '.sanitize_text_field(__($response_body->brewery->brewery_name,'garrison_brewing')).'
                                                  </span>'; 
                                    }

                                    if($response_body->beer_style)
                                    {
                                        $html_var .= '<p class="text-lg sm:text-xl leading-relaxed sm:leading-relaxed text-body-color">'.sanitize_text_field(__($response_body->beer_style,'garrison_brewing')).'</p>'; 
                                    }

                                    if($response_body->beer_abv)
                                    {
                                       $html_var .= '<p class="text-lg sm:text-xl leading-relaxed sm:leading-relaxed text-body-color">'.sanitize_text_field(__($response_body->beer_abv,'garrison_brewing')).' '.__('% ABV','garrison_brewing').'</p>';
                                    }

                                    if($response_body->beer_ibu)
                                    {
                                        $html_var .= '<p class="text-lg sm:text-xl leading-relaxed sm:leading-relaxed text-body-color">'.sanitize_text_field(__($response_body->beer_ibu,'garrison_brewing')).' '.__('IBU','garrison_brewing').'</p>';
                                    }

                                    if($checkins->count > 0 && $checkins->items)
                                    {
                                        $i = 0;
                                        $count_array = array();
                                        foreach ($checkins->items as $checkins_item) {
                                            $count_rating = $checkins_item->rating_score;
                                            array_push($count_array, $count_rating);
                                            $i++;
                                            if($i == 10) break;
                                        }

                                        $avg_rating = array_sum($count_array)/10;
                                        $avg_rating = round($avg_rating);
                                        for ($i = 0; $i < $avg_rating; $i++) { 
                                            $html_var .= '<i class="fa fa-star"></i>';
                                        }

                                        $html_var .= ' ('.$avg_rating.'/5) ('.__('10 Reviews','garrison_brewing').')';
                                    }

                                    if($response_body->beer_description)
                                    {
                                        $html_var .= '<p class="text-lg sm:text-xl leading-relaxed sm:leading-relaxed text-body-color">'.sanitize_text_field(__($response_body->beer_description,'garrison_brewing')).' IBU</p>';
                                    }

                                    if($response_body->media->count > 0)
                                    {
                                        $html_var .= '<div class="w-full mx-4">
                                                   <div class="wow fadeInUp" data-wow-delay=".2s" style="visibility: visible; animation-delay: 0.2s;">
                                                      <div class="ud-title mb-8">
                                                         <h6 class="text-xs font-normal text-body-color relative inline-flex items-center">
                                                            Beer Images
                                                            <span class="w-8 h-[1px] inline-block bg-[#afb2b5] ml-4">
                                                            </span>
                                                         </h6>
                                                      </div><div class="ud-brands-logo flex items-center flex-wrap">';
                                                $items = $response_body->media->items;

                                                foreach($items as $item)
                                                {
                                                    $beer_img = $item->photo->photo_img_sm;
                                                    if($beer_img)
                                                    {
                                                        $html_var .= '<div class="ud-single-logo mr-10 mb-5 max-w-[140px]">
                                                                <img src="'.esc_url_raw($beer_img).'" alt="" class="grayscale hover:filter-none duration-300">
                                                             </div>';
                                                    }
                                                }
                                        $html_var .= '</div>
                                                </div>
                                                    </div>';
                                    }

                                    if($response_body->brewery->brewery_label)
                                    {
                                        $html_var .= '<div class="w-full mx-4">
                                                   <div class="wow fadeInUp" data-wow-delay=".2s" style="visibility: visible; animation-delay: 0.2s;">
                                                      <div class="ud-title mb-8">
                                                         <h6 class="text-xs font-normal text-body-color relative inline-flex items-center">
                                                            Brewery Image
                                                            <span class="w-8 h-[1px] inline-block bg-[#afb2b5] ml-4">
                                                            </span>
                                                         </h6>
                                                      </div><div class="ud-brands-logo flex items-center flex-wrap">
                                                      <div class="ud-single-logo mr-10 mb-5 max-w-[140px]">
                                                        <img src="'.esc_url_raw($response_body->brewery->brewery_label).'" alt="" class="grayscale hover:filter-none duration-300">
                                                     </div>
                                                         </div>
                                                    </div>
                                                    </div>';
                                    }

                                    if($checkins->count > 0 && $checkins->items)
                                    {  

                                        $html_var .= '<section id="testimonials" class="pt-20 md:pt-[120px]" style="    max-width: 100%;">
                                            <div class="container px-4">
                                              <div class="flex flex-wrap">';
                                                $j = 0;
                                            foreach ($checkins->items as $checkins_item) {

                                                $date = date_create($checkins_item->created_at);

                                                $rate_bg = (($checkins_item->rating_score)/5)*100;

                                                $html_var .= '<div class="w-full md:w-1/2 lg:w-1/3 px-4">
                                                                <div class="ud-single-testimonial p-8 bg-white mb-12 shadow-testimonial wow fadeInUp" data-wow-delay=".1s" style="visibility: visible; animation-delay: 0.1s;">
                                                                    <div class="ud-testimonial-content mb-6">
                                                                        <p class="text-base tracking-wide text-body-color">';
                                                                        $avg_rating = round($checkins_item->rating_score);
                                                                        for ($i = 0; $i < $avg_rating; $i++) { 
                                                                            $html_var .= '<i class="fa fa-star"></i>';
                                                                        }

                                                                        if($checkins_item->rating_score > 0){
                                                                            $html_var .= ' '.$checkins_item->rating_score.'</p>';   
                                                                        }

                                                                        if($checkins_item->checkin_comment)
                                                                        {
                                                                            $html_var .= '<p class="text-base tracking-wide text-body-color">'.sanitize_text_field(__($checkins_item->checkin_comment,'garrison_brewing')).'</p>';
                                                                        }
                                                      
                                                                  $html_var .= '</div>
                                                                   <div class="ud-testimonial-info flex items-center">
                                                                      <div class="ud-testimonial-image w-[50px] h-[50px] rounded-full overflow-hidden mr-5">
                                                                      </div>
                                                                      <div class="ud-testimonial-meta">
                                                                         <h4 class="text-sm font-semibold">'.sanitize_text_field(__($checkins_item->user->first_name,'garrison_brewing')).' '.sanitize_text_field($checkins_item->user->last_name).'</h4>
                                                                         <p>Date - '.date_format($date,"Y/m/d").'</p>
                                                                      </div>
                                                                   </div>
                                                                </div>
                                                             </div>';
                                                    $j++;
                                                    if($j == 10) break;
                                            }

                                        $html_var .= '</div>
                                           </div>
                                        </section>';
                                    }

            $html_var .= '</div>
              </div>
            </div>';
        }
        return $html_var;
    }
}