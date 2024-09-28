<?php

namespace App\Http\Controllers;

use App\Http\Requests\GovernorateRequest;
use App\Interfaces\GovernorateRepositoryInterface;
use App\Models\Governorate;
use Illuminate\Http\Request;

class GovernorateController extends Controller
{
    
    public function __construct(protected GovernorateRepositoryInterface $governorateRepository) {
        $this->governorateRepository = $governorateRepository;
    }
    public function index()
    {
        $governorates = $this->governorateRepository->allGovornorates();
        // $cities = $this->governorateRepository->allcities();
        return view('admin.governorates.index',compact('governorates'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.governorates.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GovernorateRequest $request)
    {
        $this->governorateRepository->createOne($request->all());
        return to_route('governorates.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Governorate $governorate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Governorate $governorate)
    {
        return view('admin.governorates.edit',compact('governorate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GovernorateRequest $request, Governorate $governorate)
    {
        $this->governorateRepository->updateOne($request->all(),$governorate->id);
        return to_route('governorates.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Governorate $governorate)
    {
        $this->governorateRepository->removeOne($governorate->id);
        return to_route('governorates.index');
    }

    public function filterCities(Request $request)
    {
        return $this->governorateRepository->filterCities($request);
        
    }
}
