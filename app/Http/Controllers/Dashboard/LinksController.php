<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Repositories\LinkRepository;
use Illuminate\Http\Request;

class LinksController extends Controller
{
    protected $link;

    public function __construct(LinkRepository $link)
    {
        $this->link = $link;
    }

    public function links()
    {
        $list = $this->link->getAllData('*', false);
        return view('dashboard.links.link-list', ['lists' => $list]);
    }

    public function create()
    {
        return view('dashboard.links.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $this->link->store($data);
        return ajaxReturn(dashboardUrl('/links'));
    }

    public function edit($id)
    {
        return view('dashboard.links.edit', ['info' => $this->link->getById($id)]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $this->link->update($id, $data);
        return ajaxReturn(dashboardUrl('/links'));
    }

    public function destroy($id)
    {
        $this->link->destroy($id);

        return ajaxReturn(redirect()->back());
    }
}
