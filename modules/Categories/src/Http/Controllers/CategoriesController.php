<?php

namespace Modules\Categories\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Categories\src\Http\Requests\CategoryRequest;
use Modules\Categories\src\Repositories\CategoriesRepositoryInterface;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

class CategoriesController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoriesRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    public function index()
    {
        $pageTitle = "Quản lý chuyên mục";
        return view('categories::lists', compact('pageTitle'));
    }

    public function data()
    {
        $categories = $this->categoryRepository->getCategories();
        $categories = DataTables::of($categories)->toArray();
        $categories['data'] = $this->getCategoriesTable($categories['data']);
        return $categories;

    }

    public function getCategoriesTable($categories, $char = '', &$result = [])
    {
        if (!empty($categories)) {
            foreach ($categories as $key => $category) {
                $row = $category;
                $row['name'] = $char . $row['name'];
                $row['edit'] = '<a href="' . route('admin.categories.edit', $category['id']) . '" class="btn btn-warning">Sửa</a>';
                $row['delete'] = '<a href="' . route('admin.categories.delete', $category['id']) . '" class="btn btn-danger delete-action">Xóa</a>';
                $row['link'] = '<a target="_blank" href="" class="btn btn-primary">Xem</a>';
                $row['created_at'] = Carbon::parse($category['created_at'])->format('d/m/Y H:i:s');
                unset($row['sub_categories']);
                unset($row['updated_at']);
                $result[] = $row;
                if (!empty($category['sub_categories'])) {
                    $this->getCategoriesTable($category['sub_categories'], $char . '|--', $result);
                }
            }
        }

        return $result;
    }

    public function create()
    {
        $pageTitle = "Thêm chuyên mục";
        $categories = $this->categoryRepository->getAllCategories();
        return view('categories::add', compact('pageTitle', 'categories'));
    }

    public function store(CategoryRequest $categoryRequest)
    {
        $this->categoryRepository->create([
            'name' => $categoryRequest->name,
            'slug' => $categoryRequest->slug,
            'parent_id' => $categoryRequest->parent_id,
        ]);

        return redirect()->route('admin.categories.index')->with('msgSuccess', 'Thêm chuyên mục thành công');
    }

    public function edit($id)
    {
        $pageTitle = "Cập nhật chuyên mục";
        $category = $this->categoryRepository->find($id);
        if (!$category) {
            abort(404);
        }
        $categories = $this->categoryRepository->getAllCategories();
        return view('categories::edit', compact('pageTitle', 'categories', 'category'));
    }

    public function update($id, CategoryRequest $categoryRequest)
    {
        $data = $categoryRequest->except('_token');

        $status = $this->categoryRepository->update($id, $data);
        if ($status) {
            return back()->with('msgSuccess', 'Cập nhật người dùng thành công');
        }
    }

    public function delete($id)
    {
        $status = $this->categoryRepository->delete($id);
        if ($status) {
            return back()->with('msgSuccess', 'Xóa người dùng thành công');
        }
    }
}