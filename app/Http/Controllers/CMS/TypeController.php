<?php

namespace App\Http\Controllers\CMS;

use App\Constant;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Interfaces\IAdminRepository;
use App\Interfaces\ITypeRepository;
use App\Models\InformationType;
use App\Repositories\InformationTypeRepository;
use App\Repositories\RoleRepository;
use App\Repositories\TicketTypeRepository;
use App\Trait\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * @property InformationTypeRepository $type_repo
 */
class TypeController extends Controller
{
    use Service;

    public function __construct
    (
        InformationTypeRepository $typeRepository,
    ) {
        $this->type_repo = $typeRepository;
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $checkExist = InformationType::where('content', $input['content'])->first();
        if (empty($checkExist)) {
            $type = $this->type_repo->create($input);
            $this->ActivityLog('Đã tạo thông tin thêm*' . $type['id'], Auth::user()->id);
            return response()->json([
                'result' => true,
                'message' => 'Đã tạo thành công'
            ]);
        }
        return response()->json([
            'result' => false,
            'message' => 'Thông tin đã tồn tại'
        ]);
    }

    public function update(Request $request)
    {
        $input = $request->all();

        $checkExist = InformationType::where('content', $input['content'])->first();

        if (empty($checkExist)) {
            $this->type_repo->update($input['id'], $input);
            toast()->success('Cập nhật thông tin thành công');
            $this->ActivityLog('Đã cập nhật thông tin thêm*' . $input['id'], Auth::user()->id);
            return redirect()->route('dashboard.information');
        }

        toast()->error('Thông tin đã tồn tại');
        return redirect()->route('dashboard.information');
    }

    public function delete(Request $request)
    {
        $input = $request->all();

        $this->type_repo->delete($input['id']);
        $this->ActivityLog('Đã xoá thông tin thêm*' . $input['id'], Auth::user()->id);

        return response()->json([
            'result' => true,
            'message' => 'Đã xoá thành công'
        ]);
    }
}
