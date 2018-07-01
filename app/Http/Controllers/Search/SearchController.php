<?php

namespace Alumni\Http\Controllers\Search;

use Illuminate\Http\Request;
use Alumni\Http\Controllers\Controller;
use Alumni\Profile;
use Alumni\User;

class SearchController extends Controller
{
    public function index(){
        return redirect('/profiles');
    }

    public function get(Request $request)
    {
        // Get keywords from search form
        $string = $request->get('keywords');
        $category = $request->get('category');
        
        // split on 1+ whitespace & ignore empty (eg. trailing space)
        $keywords = preg_split('/\s+/', $string, -1, PREG_SPLIT_NO_EMPTY); 
        
       // Get data from get function
        $response = $this->search($keywords, $category);
        
        // Return the response with view in json format
        // return response()->json($response);
        return response()->json([
            'result' => view('searchresult')->with('data', $response)->render()
        ]);
    }
    
    private function search(array $keywords, $category)
    {
        // Set data for query.
        $data = [
            'keywords' => $keywords,
            'category' => $category
        ];
        $profile = Profile::query() // select('ime', 'prezime', 'id')
            ->where(function ($q) use ($data)
            {
                foreach ($data['keywords'] as $word)
                {
                    if (strlen($word) > 2) {
                        if ($data['category'] == 'smer') {
                            $q->orWhere('smer', 'like', "%{$word}%");
                        } elseif ($data['category'] == 'naziv_firme') {
                            $q->orWhere('naziv_firme', 'like', "%{$word}%");
                        } elseif ($data['category'] == 'godina_diplomiranja') {
                            $q->orWhere('godina_diplomiranja', 'like', "%{$word}%");
                        }  else {
                            $q->orWhere('ime', 'like', "%{$word}%")
                            ->orWhere('prezime', 'like', "%{$word}%");
                        }
                    }
                }
            })->orderBy('ime', 'asc')->paginate(10);

        return $profile;
    }
}
