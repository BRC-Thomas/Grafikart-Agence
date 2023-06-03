<?php

namespace App\Http\Controllers;

use App\Http\Requests\PropertyContactRequest;
use App\Http\Requests\SearchPropertiesRequest;
use App\Mail\PropertyContactMail;
use App\Models\Property;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PropertyController extends Controller
{
    public function index(SearchPropertiesRequest $request)
    {
        $query = Property::query()->orderBy('created_at','desc');
        if($request->validated('price')) {
            $query = $query->where('price','<=',$request->validated('price'));
        }

        $query = Property::query();
        if($request->validated('surface')) {
            $query = $query->where('surface','>=',$request->input('surface'));
        }

        $query = Property::query();
        if($request->validated('rooms')) {
            $query = $query->where('rooms','>=',$request->input('rooms'));
        }

        $query = Property::query();
        if($request->validated('title')) {
            $query = $query->where('title','like',"%{$request->input('title')}%");
        }

        return view('properties.index', [
            'properties' => $query->paginate(16),
            'input'=> $request->validated()
        ]);
    }

    public function show(string $slug, Property $property)
    {
        $expectedSlug = $property->getSlug();
        if ($slug !== $expectedSlug ){
            return to_route('properties.show',['slug'=>$expectedSlug, 'property'=>$property]);
        }

        return view('properties.show',[
            'property'=>$property
        ]);
    }

    public function contact(Property $property, PropertyContactRequest $request): RedirectResponse
    {
        Mail::send(new PropertyContactMail($property, $request->validated()));
        return back()->with('success','Votre demande de contact a bien été envoyé');
    }
}
