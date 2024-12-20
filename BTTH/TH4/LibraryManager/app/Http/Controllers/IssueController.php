<?php

namespace App\Http\Controllers;

use App\Models\ComputerM;
use App\Models\IssueModel;
use Illuminate\Http\Request;

class IssueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Lấy danh sách tất cả các vấn đề, sử dụng paginate để hiển thị phân trang
        $issues = IssueModel::with('computer')->paginate(10); // Hiển thị 10 vấn đề mỗi trang
        return view('issues.index', compact('issues'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Lấy danh sách máy tính để hiển thị trong dropdown
        $computers = ComputerM::all(); 
        return view('issues.create', compact('computers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate dữ liệu đầu vào
        $request->validate([
            'computer_id' => 'required|exists:computers,id', // Đảm bảo máy tính tồn tại
            'reported_by' => 'required|max:50',
            'reported_date' => 'required|date',
            'description' => 'required',
            'urgency' => 'required|in:Low,Medium,High', // Chỉ chấp nhận giá trị cụ thể
            'status' => 'required|in:Open,In Progress,Resolved',
        ]);

        // Tạo mới vấn đề
        IssueModel::create($request->all());

        // Chuyển hướng với thông báo thành công
        return redirect()->route('issues.index')->with('success', 'Vấn đề đã được thêm thành công!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Tìm vấn đề và danh sách máy tính
        $issues = IssueModel::findOrFail($id);
        $computers = ComputerM::all();

        return view('issues.edit', compact('issues', 'computers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate dữ liệu đầu vào
        $request->validate([
            'computer_id' => 'required|exists:computers,id', // Đảm bảo máy tính tồn tại
            'reported_by' => 'required|max:50',
            'reported_date' => 'required|date',
            'description' => 'required',
            'urgency' => 'required|in:Low,Medium,High',
            'status' => 'required|in:Open,In Progress,Resolved',
        ]);

        // Tìm và cập nhật vấn đề
        $issues = IssueModel::findOrFail($id);
        $issues->update($request->all());

        // Chuyển hướng với thông báo thành công
        return redirect()->route('issues.index')->with('success', 'Vấn đề đã được cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Tìm và xóa vấn đề
        $issues = IssueModel::findOrFail($id);
        $issues->delete();

        // Chuyển hướng với thông báo thành công
        return redirect()->route('issues.index')->with('success', 'Vấn đề đã được xóa thành công!');
    }
}
