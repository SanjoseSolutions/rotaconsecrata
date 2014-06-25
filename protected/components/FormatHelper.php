<?php
#
# This file is part of Alive Parish Software
#
# Alive Parish - software to manage tomorrow's parish
# Copyright (C) 2013  Redemptorist Media Center
#
# Alive Parish Software is free software: you can redistribute it
# and/or modify it under the terms of the GNU General Public License as
# published by the Free Software Foundation, either version 3 of the
# License, or (at your option) any later version.
#
# Alive Parish Software is distributed in the hope that it will
# be useful, but WITHOUT ANY WARRANTY; without even the implied warranty
# of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with this program.  If not, see <http://www.gnu.org/licenses/>.
#

class FormatHelper extends CComponent {
	private $dpformat = null;
	public static function getDatePickerFormat() {
		if (!isset($dpformat)) {
			$dpformat = preg_replace('/yyyy/', 'yy',
				preg_replace('/MM/', 'mm',
			        Yii::app()->locale->getDateFormat('short')));
		}
		return $dpformat;
	}

	private static function _format_dmY($d, $m, $Y) {
		return sprintf("%02d/%02d/%04d", $d, $m, $Y);
	}

	private static function _format_Ymd($d, $m, $Y) {
		return sprintf("%04d-%02d-%02d", $Y, $m, $d);
	}

	public static function dateConvDB($dt, $fmt=null) {
		if ($fmt) {
			$k = split('[-./]', $fmt);
			$v = split('[-./]', $dt);
			Yii::trace("keys=".var_export($k, true), 'application.components.FormatHelper');
			for($i=0; $i<3; ++$i) {
				switch ($k[$i]) {
					case 'd':
					case 'dd': $d = $v[$i]; break;
					case 'M':
					case 'MM': $m = $v[$i]; break;
					case 'yy': $Y = ($v[$i]>20) ? 1900+$v[$i] : 2000 + $v[$i]; break;
					case 'yyyy': $Y = $v[$i]; break;
				}
			}
			$ret = FormatHelper::_format_Ymd($d, $m, $Y);
			Yii::trace("Returned date=$ret", 'application.components.FormtHelper');
			return $ret;
		} else {
			if (preg_match('/(\d{4})[-.\/](\d\d?)[-.\/](\d\d?)/', $dt, $m)) { # Y m d
				return FormatHelper::_format_Ymd($m[3], $m[2], $m[1]);
			}
			if (preg_match('/(\d\d?)[-.\/](\d\d?)[-.\/](\d{4})/', $dt, $m)) { # d m Y
				return FormatHelper::_format_Ymd($m[1], $m[2], $m[3]);
			}
			if (preg_match('/(\d\d?)[-.\/](\d\d?)[-.\/](\d\d?)/', $dt, $m)) { # d m y
				$Y = ($m[3] > 20) ? 1900 + $m[3] : 2000 + $m[3];
				return FormatHelper::_format_Ymd($m[1], $m[2], $Y);
			}
		}
		throw new Exception("Not a valid date format: $dt");
	}

	public static function dateConvView($dt, $fmt=null) {
		if (!$fmt) {
			$fmt = 'dd/MM/yyyy';
		}
		Yii::trace("dt=$dt", 'application.components.FormatHelper');
		if (preg_match('/(\d{4})-(\d\d)-(\d\d)/', $dt, $matches)) {
			list($s, $Y, $m, $d) = $matches;
			if ($d == 0) {
				$fmt = preg_replace('/d+/', '', $fmt);
				$fmt = trim($fmt, "-/.");
				if ($m == 0) {
					$fmt = preg_replace('/M+/', '', $fmt);
					$fmt = trim($fmt, "-/.");
				}
			}
			Yii::trace("fmt = $fmt,Y-m-d=$Y-$m-$d", 'application.components.FormatHelper');
			$res = preg_replace('/yyyy/', $Y, $fmt);
			$res = preg_replace('/MM/', $m, $res);
			$res = preg_replace('/dd/', $d, $res);
			Yii::trace("res = $res", 'application.components.FormatHelper');
			return $res;
		}
			
		return FormatHelper::dateConv($dt, 'dmY', $fmt);
	}
}
