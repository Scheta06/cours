<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Configuration;
use App\Models\Processor;
use App\Services\ConfigurationService;
use App\Services\PcCompatibilityChecker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    protected $configService;

    public function __construct(ConfigurationService $configService)
    {
        $configService = $this->configService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(PcCompatibilityChecker $checker, ConfigurationService $configService)
    {
        $user = Auth::user();
        $configurationCount = Configuration::where(['user_id' => $user->id])->count();
        $configurationErrors = [];

        $userConfigurations = Configuration::where('user_id', $user->id)->get();

        $userConfigurations->each(function ($config) use ($checker) {
            $components = [
                'processor' => $config->processor,
                'motherboard' => $config->motherboard,
                'cooler' => $config->cooler,
                'rams' => $config->rams,
                'storage' => $config->storage,
                'videocard' => $config->videocard,
                'psu' => $config->psu,
                'chassis' => $config->chassis,
            ];

            $config['errors'] = $checker->check($components);
        });

        return view('pages.auth.profile', [
            'user' => $user,
            'configurationCount' => $configurationCount,
            'userConfigurations' => $userConfigurations,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        return view('pages.auth.change-password');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = Auth::user();

        return redirect()->route('login');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
