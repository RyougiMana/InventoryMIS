<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;

use App\Commodity;
use App\CommodityParent;

use Carbon\Carbon;

class CommodityController extends Controller
{
    public function index()
    {
        $parentList = $this->getParentList();
        $commodityList = $this->getCommodityList();
        $commodityLastWeek = $this->getCommodityLastWeek();

        return view('inventory.commodity', compact('parentList', 'commodityList', 'commodityLastWeek'));
    }

    private function getParentList()
    {
        $parentList = [];
        $commodityParents = CommodityParent::where('is_deleted', 0)
            ->orderby('updated_at', 'desc')
            ->get();

        foreach ($commodityParents as $commodityParent) {
            $parentList[$commodityParent->id] = $commodityParent->name;
        }
        return $parentList;
    }

    private function getCommodityList()
    {
        $commodityList = [];
        $commodityParents = CommodityParent::where('is_deleted', 0)
            ->orderby('updated_at', 'desc')
            ->get();

        foreach ($commodityParents as $commodityParent) {
            $tmpList = [];
            $commodities = Commodity::where('parent_id', $commodityParent->id)
                ->orderby('updated_at', 'desc')
                ->get();
            foreach ($commodities as $commodity) {
                array_push($tmpList, $commodity);
            }
            $commodityList[$commodityParent->id] = $tmpList;
        }
        return $commodityList;
    }

    private function getCommodityLastWeek()
    {
        $currentTime = Carbon::now()->addHours(8);
        $lastWeek = Carbon::now()->addHours(8)->subWeek();
        $commodityLastWeek = DB::table('commodities')
            ->where('created_at', '>=', $lastWeek)
            ->where('created_at', '<=', $currentTime)
            ->get();
        return $commodityLastWeek;
    }

    private function str_trim($value)
    {

        $value = str_replace("全角空格", " ", trim($value));
        $value = preg_replace("/^[\s\v" . chr(194) . chr(160) . "]+/", "", $value);
        $value = preg_replace("/[\s\v" . chr(194) . chr(160) . "]+$/", "", $value);

        return $value;

    }

    private function getParentId($parentName)
    {
        $parentName = $this->str_trim($parentName);
        $parentIdSet = CommodityParent::where('is_deleted', 0)
            ->where('name', $parentName)
            ->get();
        if (count($parentIdSet) != 0) {
            $parentId = $parentIdSet[0]['id'];
        } else {
            $parentId = -1;
        }
        return $parentId;
    }

    public function getCommodityClassification(Request $request)
    {

        $parentList = $this->getParentList();
        $commodityList = $this->getCommodityList();

        return compact('parentList', 'commodityList');

    }

    public function post(Request $request)
    {

        $action = $request['action'];
        $input = $request->all();

        switch ($action) {
            case 'add-commodity-classification':
                $this->validate($request, [
                    'name' => 'required|unique:commodity_parents|min:1|max:45',
                ]);
                $input['name'] = $this->str_trim($input['name']);
                $input['created_at'] = Carbon::now()->addHours(8);
                $input['updated_at'] = Carbon::now()->addHours(8);
                CommodityParent::create($input);
                break;

            case 'add-commodity':
                $this->validate($request, [
                    'name' => 'required|unique:commodity_parents|min:1|max:45',
                    'parent_name' => 'required',
                    'classification' => 'required|min:1|max:45',
                    'purchase_price' => 'required',
                    'retail_price' => 'required'
                ]);
                $parentId = $this->getParentId($this->str_trim($request['parent_name']));
                if ($parentId != -1) {
                    $input['parent_id'] = $parentId;
                    $input['name'] = $this->str_trim($input['name']);
                    $input['count'] = 0;
                    $input['recent_purchase_price'] = $input['purchase_price'];
                    $input['recent_retail_price'] = $input['retail_price'];
                    $input['is_deleted'] = 0;
                    $input['created_at'] = Carbon::now()->addHours(8);
                    $input['updated_at'] = Carbon::now()->addHours(8);
                    Commodity::create($input);
                } else {
                    dd("Add commodity error");
                }
                break;

            case 'modify-commodity-classification':
                $parentId = $this->getParentId($this->str_trim($request['parent_name']));
                if ($parentId != -1) {
                    $request['name'] = $this->str_trim($request['new_name']);
                    $this->validate($request, [
                        'name' => 'required|unique:commodity_parents|min:1|max:45'
                    ]);
                    $parent = CommodityParent::find($parentId);
                    $parent['updated_at'] = Carbon::now()->addHours(8);
                    $parent['name'] = $this->str_trim($request['new_name']);
                    $parent->save();
                } else {
                    dd("Modify commodity classification error");
                }
                break;

            case 'modify-commodity':
                $request['new_name'] = $this->str_trim($request['new_name']);
                $request['new_parent_name'] = $this->str_trim($request['new_parent_name']);
                $request['name'] = $this->str_trim($request['name']);
                $request['parent_name'] = $this->str_trim($request['parent_name']);

                /* judge if there exists a commodity belongs to the certain parent */
                $parentId = $this->getParentId($request['parent_name']);
                if ($parentId != -1) {
                    $commodityIdSet = Commodity::where('is_deleted', 0)
                        ->where('parent_id', $parentId)
                        ->where('name', $request['name'])
                        ->get();
                    if (count($commodityIdSet) != 0) {
                        $commodityId = $commodityIdSet[0]['id'];
                        if ($request['parent_name'] === $request['new_parent_name']) {
                            dd("whos");
                            $this->validate($request, [
                                'name' => 'required|unique:commodities|min:1|max:45',
                                'parent_name' => 'required',
                                'classification' => 'required|min:1|max:45',
                                'purchase_price' => 'required',
                                'retail_price' => 'required'
                            ]);
                        } else {
                            $this->validate($request, [
                                'name' => 'required|min:1|max:45',
                                'parent_name' => 'required',
                                'classification' => 'required|min:1|max:45',
                                'purchase_price' => 'required',
                                'retail_price' => 'required'
                            ]);
                        }

                        /* get new parent's id */
                        $parentId = $this->getParentId($request['new_parent_name']);
                        if ($parentId != -1) {
                            $commodity = Commodity::find($commodityId);
                            $commodity['name'] = $request['new_name'];
                            $commodity['parent_id'] = $parentId;
                            $commodity->save();
                        } else {
                            dd("新分类不存在,请先创建.");
                        }
                    }
                } else {
                    dd("该分类下的该商品不存在!");
                }
                break;

            case 'delete-commodity-classification':
                $parentId = $this->getParentId($this->str_trim($request['parent_name']));
                if ($parentId != -1) {
                    $commodities = Commodity::where('parent_id', $parentId)
                        ->get();
                    if (count($commodities) == 0) {
                        $parent = CommodityParent::find($parentId);
                        $parent['is_deleted'] = 1;
                        $parent->save();
                    } else {
                        dd("请不要删除有商品的分类!");
                    }
                } else {
                    dd("Delete commodity classification error");
                }
                break;

            case 'delete-commodity':
                $commodityIdSet = Commodity::where('name', $this->str_trim($request['name']))
                    ->get();
                if (count($commodityIdSet) != 0) {
                    $commodityId = $commodityIdSet[0]['id'];
                    $commodity = Commodity::find($commodityId);
                    $commodity['is_deleted'] = 1;
                    $commodity->save();
                } else {
                    dd("Delete commodity error");
                }
                break;

            default:
                break;
        }

        $parentList = $this->getParentList();
        $commodityList = $this->getCommodityList();
        $commodityLastWeek = $this->getCommodityLastWeek();

        return view('inventory.commodity', compact('parentList', 'commodityList', 'commodityLastWeek'));
    }

}
