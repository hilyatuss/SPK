<?php

namespace App;

class WP
{
    public $atribut;
    public $bobot;
    public $rel_alternatif;

    public $bobot_normal;
    public $pangkat;
    public $normal;
    public $vektor_s;
    public $vektor_v;
    public $rank;

    function __construct($rel_alternatif, $atribut, $bobot)
    {
        $this->rel_alternatif = $rel_alternatif;
        $this->atribut = $atribut;
        $this->bobot = $bobot;

        $this->get_bobot_normal();
        $this->get_normal();
        $this->get_vektor();
        $this->get_rank();
    }

    function get_rank()
    {
        $arr = $this->vektor_v;
        arsort($arr);
        $no = 1;
        foreach ($arr as $key => $val) {
            $this->rank[$key] = $no++;
        }
    }

    function get_vektor()
    {
        foreach ($this->normal as $key => $val) {
            $this->vektor_s[$key] = 1;
            foreach ($val as $k => $v) {
                $this->vektor_s[$key] *= $v;
            }
        }
        foreach ($this->vektor_s as $key => $val) {
            $this->vektor_v[$key] = $val / array_sum($this->vektor_s);
        }
    }

    function get_normal()
    {
        foreach ($this->rel_alternatif as $key => $val) {
            foreach ($val as $k => $v) {
                $this->normal[$key][$k] = pow($v, $this->pangkat[$k]);
            }
        }
    }

    function get_bobot_normal()
    {
        foreach ($this->bobot as $key => $val) {
            $this->bobot_normal[$key] = $val / array_sum($this->bobot);
            $this->pangkat[$key] = ($this->atribut[$key] == 'benefit' ? 1 : -1) * $this->bobot_normal[$key];
        }
    }
}
