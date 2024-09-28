<?php

namespace App\Http\Controllers;

use App\Http\Requests\CityRequest;
use App\Interfaces\CityRepositoryInterface;
use App\Interfaces\GovernorateRepositoryInterface;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function __construct(protected CityRepositoryInterface $cityRepository,protected GovernorateRepositoryInterface $governorateRepository) {
        $this->cityRepository = $cityRepository;
        $this->governorateRepository = $governorateRepository;
        $this->middleware('permission:city-list', ['only' => ['index']]);
        $this->middleware('permission:city-create', ['only' => ['create','store','addPermissionToRole','givePermissionToRole']]);
        $this->middleware('permission:city-edit', ['only' => ['update','edit']]);
        $this->middleware('permission:city-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $cities =$this->cityRepository->allCities();
        return view('admin.cities.index',compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $governorates = $this->governorateRepository->allGovornorates();
        return view('admin.cities.create',compact('governorates'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CityRequest $request)
    {
      
        $this->cityRepository->createOne($request->all());
        return to_route('cities.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(City $city)
    {
        $governorates = $this->governorateRepository->allGovornorates();
        return view('admin.cities.edit',compact('city','governorates'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CityRequest $request, City $city)
    {
      
        $this->cityRepository->updateOne($request->all(),$city->id);

        return to_route('cities.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(City $city)
    {
        $this->cityRepository->removeOne($city->id);
        return to_route('cities.index');
    }
}
