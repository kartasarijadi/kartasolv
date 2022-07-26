<?php

namespace App\Models;

use App\Libraries\DatabaseManager;
use App\Libraries\Model;

/**
 * Table Members model.
 * @see https://codeigniter.com/user_guide/models/model.html for instructions.
 * @package KartasolvApp\Models
 */
class MembersModel extends Model
{
    protected $table = 'members';
    protected $primaryKey = 'member_id';
    protected $useTimestamps = true;
    protected $allowedFields = ['member_name', 'member_position', 'member_type', 'member_active', 'member_image'];
    protected $returnType     = 'object';
    protected $useSoftDeletes = true;
    protected $beforeInsert = ['setCreatedBy'];
    protected $beforeUpdate = ['setModifiedBy'];
    protected $afterDelete = ['setDeletedBy'];
    protected $validationRules = [
        'member_name' => [
            'label' => 'Judul Utama',
            'rules' => 'required|max_length[64]|string',
        ],
        'member_position' => [
            'label' => 'Tagline',
            'rules' => 'required|max_length[256]|string',
        ],
        'member_type' => [
            'label' => 'Jenis Pengurus',
            'rules' => 'required|in_list[1,2,3,4]',
            'errors' => [
                'in_list' => 'Kamu hanya dapat memilih antara Ketua, Top Level, Kabid, atau Anggota!'
            ]
        ],
        'member_active' => [
            'label' => 'Aktif',
            'rules' => 'in_list[Aktif,Nonaktif]|permit_empty',
            'errors' => [
                'in_list' => 'Kamu Hanya Dapat Memilih Opsi Aktif/Nonaktif.'
            ]
        ],
        'member_image' => [
            'label' => 'Foto Pengurus',
            'rules' => 'is_image[member_image]|ext_in[member_image,png,jpg,jpeg,webp]|uploaded[member_image]|max_size[member_image,1024]',
            'errors' => [
                'max_size' => 'Maksimal ukuran berkas adalah 1 MB!'
            ]
        ],

    ];

    /**
     * Get members data for landing page.
     * @return array Retrieved members data.
     */
    public function getMembers()
    {
        return $this->where('member_active', 1)->orderBy('member_type, member_id', 'asc')->findAll();
    }

    /**
     * Retrieve Datatables.
     * @see \App\Libraries\DatabaseManager for complete instructions.
     * @param mixed $condition Condition retrieved from the controller.
     * @return object Objectified result.
     */
    public function getDatatable($condition)
    {
        $dbMan = new DatabaseManager;
        $query = [
            'result' => 'result',
            'table'  => 'members',
            'select' => ['member_id', 'member_name', 'member_position', 'member_type', 'member_active', 'member_image'],
        ];

        $query += $dbMan->filterDatatables($condition);
        $query['orderBy'] .= ', member_id ASC';
        $data = [
            'totalRows' => $dbMan->countAll($query),
            'result' => $dbMan->read($query),
            'searchable' => array_map(function ($e) {
                return $e . ":name";
            }, $condition['columnSearch'])
        ];

        return objectify($data);
    }
}
