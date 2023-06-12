public function OpenTanggal(Request $request)
    {
        $begin = new DateTime('now');

        $akhir = date('d-m-Y', strtotime('now' . "+20 days"));
        $end = new DateTime($akhir);

        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($begin, $interval, $end);

        $tanggal = [];
        $hari = [];

        $html = '';

        $html .= '<audio autoplay="true">
                            <source src="' . asset('sound/tanggal.mp3') . '" type="audio/mpeg">
                        </audio>';

        foreach ($period as $dt) {
            $tanggal[] = $dt->format("d");
            if ($request->kelurahan) {
                $antrian = T_count_antrian::where('id_kec', $request->kecamatan)->where('id_kel', $request->kelurahan)->where('id_m_layanan', $request->id_layanan)->where('tanggal_layanan', $dt->format('Y-m-d'))->first();
            }else{
                $antrian = T_count_antrian::where('id_kec', $request->kecamatan)->whereNull('id_kel')->where('id_m_layanan', $request->id_layanan)->where('tanggal_layanan', $dt->format('Y-m-d'))->first();
            }

            $hari[] = \App\Helpers\Helper::hariIndo(date('D', strtotime($dt->format('Y-m-d'))));

            $is_disabled = false;

            $libur = T_hari_libur::where('tanggal', $dt->format('Y-m-d'))->first();

            if(\App\Helpers\Helper::hariIndo(date('D', strtotime($dt->format('Y-m-d')))) == 'Minggu'){
                $bg = 'bg-red-turquoise';
                $is_disabled = true;
            }else{
                if ($libur) {
                    $bg = 'bg-red-turquoise';
                    $is_disabled = true;
                } else {
                    $bg = 'bg-green-turquoise';
                }
            }

            if ($dt->format("d") == (int)date('d')) {
                // $bg = 'active bg-green-turquoise';
            }

            $jml_antrian = $antrian && $antrian->jum_antrian ? $antrian->jum_antrian : 0;

            $html .= '<div class="tile '.$bg.' jadwal" style="background: #8ACCFF; width:110px; height:110px;" data-tanggal="'.$dt->format('Y-m-d').'" data-disabled="' . $is_disabled . '">
                            <div class="corner" style="float: left; font-weight: bold; color:#fff">
                                <span>' . \App\Helpers\Helper::hariIndo(date('D', strtotime($dt->format('Y-m-d')))) . '</span>
                            </div>
                            <div class="corner" style="float: right; font-weight: bold; color:#fff">
                                <span>'.$jml_antrian.'</span>
                            </div>
                            <div class="tile-body" style="overflow:initial;font-weight: bold;color:black">
                                <i style="font-style:normal;">' . $dt->format("d") . '</i>
                            </div>
                            <div class="tile-object">
                                <div class="name">' . \App\Helpers\Helper::bulan($dt->format("m")) . '</div>
                                <div class="number">'.$dt->format("Y").'</div>
                            </div>
                        </div>';

        }

        echo $html;
    }