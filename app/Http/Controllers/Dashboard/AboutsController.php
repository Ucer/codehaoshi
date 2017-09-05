<?php

namespace App\Http\Controllers\Dashboard;

use App\Repositories\AboutRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutsController extends Controller
{
    protected $about;

    public function __construct(AboutRepository $about)
    {
        $this->about = $about;
    }

    public function abouts()
    {
        $list = $this->about->getAllData('*', false);
        return view('dashboard.abouts.about-list', ['lists' => $list]);
    }

    public function create()
    {
        return view('dashboard.abouts.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $this->about->store($data);
        return ajaxReturn(dashboardUrl('/abouts'));
    }

    public function edit($id)
    {
        return view('dashboard.abouts.edit', ['info' => $this->about->getById($id)]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $this->about->update($id, $data);
        return ajaxReturn(dashboardUrl('/abouts'));
    }

    public function destroy($id)
    {
        $this->about->destroy($id);

        return ajaxReturn(redirect()->back());
    }
}
