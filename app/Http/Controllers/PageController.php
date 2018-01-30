<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    protected $data = [
        [
            'name' => 'Gianni', 
            'lastname' => 'Magni'
        ],
        [
            'name' => 'Pinotto',
            'lastname' => 'Dai'
        ],
        [
            'name' => 'Pluto',
            'lastname' => 'Perro'
        ]
    ];
    
    public function about()
    {
      return view('about',
            [
                'img_url'=>'http://lorempixel.com/400/200/',
                'img_title'=>'Image About',
                'slot'=>'Roba di paginaaaaa!!!! :D :D :D'
            ]
      );
    }

    public function staff()
    {
        /*return view('staff', 
            [
             'title' => 'Our Staff', 
             'staff' => $this->data
            ]
        );*/
        
        //return view('staff')->with('title',"Our Staff")->with('staff',$this->data);
        
        //return view('staff')->withTitle('Our Staff')->withStaff($this->data);
        
        $staff = $this->data;
        $title = 'Our Staff';
        return view('staffb', compact('title','staff'));
    }
}
