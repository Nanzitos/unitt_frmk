<?php

class ServerInfo {

    function Dbyte($Wert) {

        if ($Wert >= 1099511627776) {
            $Wert = round($Wert / 1099511627776, 1) . " TB";
        } elseif ($Wert >= 1073741824) {
            $Wert = round($Wert / 1073741824, 1) . " GB";
        } elseif ($Wert >= 1048576) {
            $Wert = round($Wert / 1048576, 1) . " MB";
        } elseif ($Wert >= 1024) {
            $Wert = round($Wert / 1024, 1) . " kB";
        } else {
            $Wert = round($Wert, 0) . " Bytes";
        }

        return $Wert;
    }

    function Network($eth = false) {
        if (!$eth) {
            $eth = "venet0";
        }
        $r1 = file_get_contents("/sys/class/net/$eth/statistics/rx_bytes");
        $t1 = file_get_contents("/sys/class/net/$eth/statistics/tx_bytes");
        sleep(1);
        $r2 = file_get_contents("/sys/class/net/$eth/statistics/rx_bytes");
        $t2 = file_get_contents("/sys/class/net/$eth/statistics/tx_bytes");
        $upload = $r2 - $r1;
        $download = $t2 - $t1;
        return array(
            "upload" => round($upload / 1048576, 1),
            "download" => round($download / 1048576, 1),
            "upload_total" => $this->Dbyte($r2),
            "download_total" => $this->Dbyte($t2),
        );
    }

    function Cpu() {
        $load = sys_getloadavg();
        return round($load[0], 1);
    }

    function Memory() {
        $mem = file_get_contents("/proc/meminfo");
        if (preg_match('/MemTotal\:\s+(\d+) kB/', $mem, $matches)) {
            $total = $matches[1];
        }
        unset($matches);
        if (preg_match('/MemFree\:\s+(\d+) kB/', $mem, $matches)) {
            $free = $matches[1];
        }
        $free;
        $total;
        $usage = $total - $free;
        $precent = 100 * $usage / $total;
        return array(
            "total" => $this->Dbyte($total * 1024),
            "free" => $this->Dbyte($free * 1024),
            "usage" => $this->Dbyte($usage * 1024),
            "precent" => round($precent, 1),
        );
    }

    function Disk($disk = false) {
        if (!$disk) {
            $disk = './';
        }
        $free = disk_free_space($disk);
        $total = disk_total_space($disk);
        $usage = $total - $free;
        $precent = 100 * $usage / $total;
        return array(
            "total" => $this->Dbyte($total),
            "free" => $this->Dbyte($free),
            "usage" => $this->Dbyte($usage),
            "precent" => round($precent, 1),
        );
    }

    function Total($disk = false, $eth = false) {
        $Network = $this->Network($eth);
        $Cpu = $this->Cpu();
        $Memory = $this->Memory();
        $Disk = $this->Disk($eth);
        return array(
            "network" => $Network,
            "cpu" => $Cpu,
            "memory" => $Memory,
            "disk" => $Disk,
        );
    }

}

?>