<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContatoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
      switch ($this->method()) {
        case "POST":
          return [
            'saudacao'=>'required|max:10',
            'nome'=>'required|max:100',
            'telefone'=>'required|max:15',
            'email'=>'email|max:200|unique:contatos,email,'.$this->id,
            //'data_nascimento'=>'date_format:"d/m/Y"',
            'avatar'=>'mullable|sometimes|image|mimes:jpg,jpeg,png,gif'

          ];

          break;

        case "PUT":
          return [
            'saudacao'=>'required|max:10',
            'nome'=>'required|max:100',
            'telefone'=>'required|max:15',
            'email'=>'email|max:200|unique:contatos',
            //'data_nascimento'=>'date_format:"d/m/Y"',
            'avatar'=>'mullable|sometimes|image|mimes:jpg,jpeg,png,gif'
          ];
          break;

        default:
          // code...
          break;
      }
    }

    public function messagens()
    {
      return[
        'saudacao.required'=>'0 campo saudação é obrigatório',
        'nome.required'=>'0 campo nome é obrigatório',
        'email.email'=>'Informe um email válido',
        'telefone.required'=>'0 campo telefone é obrigatório'
      //  'data_nascimento.date_format'=>'0 campo data deve ser no formato DD/MM/AAAA'
      ];
    }
}
