<?php

namespace App\Http\Controllers;

class ViewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("index");
    }

    public function avaliacao()
    {
        return view("avaliacao");
    }
    public function buscaDeAlunos()
    {
        return view("buscaDeAlunos");
    }
    public function cadastro2()
    {
        return view("cadastro2");
    }
    public function cadastro()
    {
        return view("cadastro");
    }
    public function homeModerador()
    {
        return view("homeModerador");
    }
    public function login()
    {
        return view("login");
    }
    public function novaSenha()
    {
        return view("novaSenha");
    }
    public function redefinirSenha()
    {
        return view("redefinirSenha");
    }
    public function updateEgress()
    {
        return view("updateEgress");
    }
    public function visualizarPerfil()
    {
        return view("visualizarPerfil");
    }
    public function homeAdministrador()
    {
        return view("homeAdministrador");
    }

}
