<?php

namespace App\Services;

use Illuminate\Support\Str;

class HtmlBuilder extends \Collective\Html\HtmlBuilder
{
   
    public function linkResource(string $uri, $parameter)
    {
        if (auth()->user()->can($uri.'.show') || auth()->user()->can($uri.'.edit') || auth()->user()->can($uri.'.destroy')) {
            $html ='';
            if (auth()->user()->can($uri.'.show')) {
                $html .='<a href="'.route($uri.'.show', $parameter['id']).'" class="btn btn-sm btn-info text-white btn-load"><i class="fas fa-eye"></i></a> &nbsp;';
            }

            if (auth()->user()->can($uri.'.edit')) {
                $html .='<a href="'.route($uri.'.edit', $parameter['id']).'" class="btn btn-sm btn-warning text-white btn-load"><i class="fas fa-edit"></i></a> &nbsp;';               
            }

            if (auth()->user()->can($uri.'.destroy')) {
                // $html .='<a href="'.route($uri.'.destroy', $parameter['id']).'"  rel="delete" class="btn btn-sm btn-danger text-white btn-load"><i class="fas fa-trash-alt"></i></a> &nbsp;';               
                $html .='<a href="'.route($uri.'.destroy', $parameter['id']).'" rel="delete" class="btn btn-sm btn-danger text-white btn-load" data-id="'.$parameter['id'].'"><i class="fas fa-trash-alt"></i></a> &nbsp;';               
           
            }

            // $html .= '</div></button>';

            return $this->toHtmlString($html);
        }

        return __('label.no_action');
    }

    public function linkPemadananPokok25(string $uri, $parameter)
    {
            $html ='';
            if (auth()->user()->can($uri.'.show')) {
                $html .='<a href="'.route($uri.'.show', $parameter['id']).'" class="btn btn-sm btn-info text-white btn-load"><i class="fas fa-eye"></i></a> &nbsp;';
                $html .='<a href="'.route($uri.'.edit', $parameter['id']).'" class="btn btn-sm btn-warning text-white btn-load"><i class="fas fa-edit"></i></a> &nbsp;';           
                // $html .='<a href="'.route($uri.'.generateangsuran', $parameter['id']).'" class="btn btn-sm btn-danger text-white btn-load"><i class="fas fa-retweet"></i></a> &nbsp;';
                // $html .='<a href="'.route($uri.'.generateTarif', $parameter['id']).'" class="btn btn-sm btn-danger text-white btn-load"><i class="fas fa-retweet"></i></a> &nbsp;';
            }

            return $this->toHtmlString($html);
        

        return __('label.no_action');
    }

    public function linkPemadananPokok90(string $uri, $parameter)
    {
            $html ='';
            if (auth()->user()->can($uri.'.show')) {
                $html .='<a href="'.route($uri.'.show', $parameter['id']).'" class="btn btn-sm btn-info text-white btn-load"><i class="fas fa-eye"></i></a> &nbsp;';
                $html .='<a href="'.route($uri.'.edit', $parameter['id']).'" class="btn btn-sm btn-warning text-white btn-load"><i class="fas fa-edit"></i></a> &nbsp;';           
                // $html .='<a href="'.route($uri.'.generateangsuran', $parameter['id']).'" class="btn btn-sm btn-danger text-white btn-load"><i class="fas fa-retweet"></i></a> &nbsp;';
                // $html .='<a href="'.route($uri.'.generateTarif', $parameter['id']).'" class="btn btn-sm btn-danger text-white btn-load"><i class="fas fa-retweet"></i></a> &nbsp;';
            }

            return $this->toHtmlString($html);
        

        return __('label.no_action');
    }



}