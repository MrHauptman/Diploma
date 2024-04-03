<?php

namespace App\Http\Requests;
use App\Models\File;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ParentIdBaseRequest extends FormRequest
{

    public ?File $parent = null;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $this->parent = File::query()->where('id', $this->input('parent_id'))->first();

        if ($this->parent && !$this->parent->isOwnedBy(Auth::id())) {
            return false;
        }
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'parent_id' => [
                Rule::exists(File::class, 'id')
                    ->where(function (Builder $query) {
                        return $query
                            ->where('is_folder', '=', '1')
                            ->where('created_by', '=', Auth::id());
                    })
            ]
        ];
    }
}
 /**
  * Эта функция является методом в классе формы (Form Request) в Laravel и используется для определения правил валидации данных, переданных в запросе. В данном примере функция rules() определяет правило валидации для поля parent_id. Правило включает проверку существования значения parent_id в таблице files (представленной моделью File::class) в колонке id. Однако, правило включает дополнительные условия для проверки.
 * Внутри метода where() используется анонимная функция, в которой определяются дополнительные условия для запроса. В данном случае, используется экземпляр Builder (класс из пакета Laravel Query Builder), который представляет запрос к базе данных. Внутри функции where() определены два условия:
   * where('is_folder', '=', '1') - это условие проверяет, что значение столбца is_folder равно 1. То есть, проверяется, что файл с указанным parent_id является папкой.
    *where('created_by', '=', Auth::id()) - это условие проверяет, что значение столбца created_by равно идентификатору текущего аутентифицированного пользователя (Auth::id()). То есть, проверяется, что файл с указанным parent_id был создан текущим пользователем.
*Таким образом, функция rules() возвращает массив, содержащий правила валидации для полей в запросе. В данном случае, для поля parent_id определено правило, которое проверяет существование значения parent_id в таблице files, при выполнении двух дополнительных условий: файл должен быть папкой и быть созданным текущим пользователем.
  */