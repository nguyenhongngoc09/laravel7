<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use PDO;

class CodeController extends Controller
{
    public function solve()
    {
        //$result = $this->maxConsecutiveOnes();
        // $result = $this->countTotalNumberHasEvenNumber();
        // $result = $this->bubbleSort();
        // $result = $this->insertionSort();
        // $result = $this->selectionSort();
        // $result = $this->duplicateZeroes();
        // $result = $this->mergeSortedArray();
        // $result = $this->binarySearch();
        // $result = $this->recursion();
        // $result = $this->reverseString();
        $result = $this->binarySearch();

        // Solve problem
        echo $result;
    }


    /**
     * $array = [1,1,0,1,1,1];
     * Show count max consecutive ones
    */
    public function maxConsecutiveOnes()
    {
        $input = [0,0,0,1,1,0];

        $count = $max = 0;

        for ($i = 0; $i < count($input); $i++) {
            $count = $input[$i] == 0 ? 0 : $count + 1;
            $max = max([$max, $count]);
        }

        return $max;
    }

    /**
     * $input = [12,1,3,1023];
     * Show count numbers has even digits
    */
    public function countTotalNumberHasEvenNumber()
    {
        $input = [22,13,3211,10231];

        $count = 0;

        // log way
        $resultInput = array_filter($input, function($num) {
            return !(log10($num)+1 & 1);
        });

        $count = count($resultInput);

        // normal way;
        // for ($i = 0; $i < count($input); $i++) {
        //     $digits = strlen($input[$i]);

        //     if ($digits % 2 == 0) {
        //         $count++;
        //     }
        // }

        return $count;
    }

    /**
     * Chạy từ đầu đến cuối mảng
     * Nếu phần tử trc mà lớn hơn phần tử sau -> Đổi chỗ
     * Sau mỗi vòng lặp thì phần tử lớn nhất sẽ ở cuối mảng
     **/
    public function bubbleSort()
    {
        $a = [4,2,1,3,6,5];
        $n = count($a);
        for ($i = 0; $i < $n; $i++) {
            $isSorted = true;
            for ($j = 0; $j < $n-$i-1; $j++) {
                if ($a[$j] > $a[$j+1]) {
                    $isSorted = false;

                    // swap
                    $tmp = $a[$j];
                    $a[$j] = $a[$j+1];
                    $a[$j+1] = $tmp;
                }
            }

            var_dump(implode(',', $a));
            if ($isSorted) {
                break;
            }
        }

        return implode(',', $a);
    }

    /**
     * Chạy từ đầu đến cuối mảng
     * Tại vòng lặp i, coi như mảng [0,i-1] đã đc sắp xếp, chèn a[i] vào vi tri thich hop
     * Sau vòng lặp i thì [0,i] đã đc sắp xếp
    */ 
    public function insertionSort()
    {
        $a = [4,2,1,3,6,5];
        $n = count($a);

        for ($i = 1; $i < $n; $i++) {
            $ai = $a[$i];
            $j = $i-1;

            while ($j >= 0 && $ai < $a[$j]) {
                $a[$j+1] = $a[$j];
                $j--;
            }

            $a[$j+1] = $ai;
            var_dump(implode(',', $a));
        }

        return implode(',', $a);
    }

    /**
     * Chạy từ đầu đến cuối mảng
     * Tại vòng lặp thứ i, tìm phần tử nhỏ nhất từ [i+1, n-1] nếu nhỏ hơn a[i]=> đổi chỗ a[i]
     * Sau vòng lặp i thì [0,i] đã đc sắp xếp
    */
    public function selectionSort()
    {
        $a = [4,2,2,3,1,5];
        $n = count($a);

        for ($i = 0; $i < $n; $i++) {
            $minIndex = $i;
            for ($j = $i+1; $j < $n; $j++) {
                if ($a[$j] < $a[$minIndex]) {
                    $minIndex = $j;
                }
            }

            if ($minIndex != $i) {
                $tmp = $a[$i];
                $a[$i] = $a[$minIndex];
                $a[$minIndex] = $tmp;
            }

            var_dump(implode(',', $a));
        }

        return implode(',', $a);
    }

    /**
     * $a = [1,0,2,4,0,5,0];
     * Nhân đôi số 0 trong mảng giữ nguyên size của mảng
     * 
    */
    public function duplicateZeroes()
    {
        $a = [1,0,2,4,0,5,0,4,2];

        $n = count($a);

        for ($i = 0; $i < $n; $i++) {
            if ($a[$i] == 0 && $i!=$n-1) {
                // Move to right 1 step
                for ($j = $n-2; $j>=$i+1; $j--) {
                    $a[$j+1] = $a[$j];
                }
                $a[$i+1] = 0;
                $i++;
            }
            var_dump(implode(',', $a));
        }

        return implode(',', $a);
    }

    /**
     * $a1 = [1,2,3,0,0,0];
     * $a2 = [2,4,6];
     * 
     * => OutPut = [1,2,2,3,4,6]
    */
    public function mergeSortedArray()
    {
        $a1 = [1,2,3,0,0,0]; $n1 = 3;
        $a2 = [2,5,6]; $n2 = count($a2);

        $i = $n1-1;
        $j = $n2-1;
        $k = $n1+$n2-1;

        while ($i >=0 || $j >= 0) {
            if ($i >= 0 && $j >= 0) {
                if ($a1[$i] >= $a2[$j]) {
                    $a1[$k] = $a1[$i];
                    $i--;
                } else {
                    $a1[$k] = $a2[$j];
                    $j--;
                }
            } else if ($i>=0) {
                $a1[$k] = $a1[$i];
                $i--;
            } else {
                $a1[$k] = $a2[$j];
                $j--;
            }

            $k--;

            var_dump(implode(',', $a1)); 
        }
       
        return implode(',', $a1);
    }

    /**
     * $a = [1,2,4,2,1,3]; $val = 2;
     * Output $a = [1,4,1,3,_,_];
    */
    public function removeElement() {
        $a = [1,1,2,2,1,2]; $val = 2;
        $n = count($a);

        $i = 0;
        while ($i < $n) {
            if ($a[$i] == $val) {
                for ($j = $i; $j<$n-1;$j++) {
                    $a[$j] = $a[$j+1];
                }
                $a[$n-1] = '_';
                $n--;
            } else {
                $i++;
            }
            var_dump(implode(',', $a) . '-- k = '. $n);
        }

        return implode(',', $a);
    }

    /**
     * Đệ quy
    */
    public function recursion()
    {
        $n = 8;
        
        // return $this->giaiThua($n);
        $a = [];

        $i = 0;
        while ($i <= $n) {
            $a[$i] = $this->fib($i);
            $i++;
        }

        return implode(',', $a);
    }

    /**
     * Tính giai thừa
     * Bài toán cơ sở: 0! = 1; ==> __giaiThua(0) = 1;
     * Tổng quát: n! = n*(n-1)!; ==> __giaiThua(n) = n*__giaiThua(n-1);
     * 
    */
    public function giaiThua($n)
    {
        // Bài toán cơ sở
        if ($n == 0) {
            return 1;
        }

        // Công thức tổng quát
        return $n * $this->giaiThua($n-1);
    }

    /**
     * Dãy số Fibonacci: Với 2 số ban đầu là 0, 1 hoặc 1, 1 thì số tiếp
     * theo là tổng của 2 số liền trước nó
     * 
     * Công thức tổng quát: F(n) = F(n-1)+ F(n-2) 
    */
    public function fib($n) 
    {
        // var_dump($n);
        // Bai toan co so
        if ($n < 2) {
            return 1;
        }

        // Cong thuc tong quat
        return $this->fib($n-1) + $this->fib($n-2);
    }

    /**
     * Ham Fibonacci bằng cách tối ưu đệ quy bằng cách nhớ
     * 
    */

    /**
     * $a = ['h', 'e', 'l', 'l', 'o'];
     * 
     * $output = ['o', 'l', 'l', 'e', 'h']
    */
    public function reverseString()
    {
        $a = ['h', 'e', 'l', 'a','s'];
        $n = count($a);

        // Normal way
        // $j = $n-1;
        // for ($i = 0; $i < $n; $i++) {
        //     if ($j > $i) {
        //         $tmp = $a[$i];
        //         $a[$i] = $a[$j];
        //         $a[$j] = $tmp;
        //     }

        //     $j--;
        // }

        // recursion way
        $this->swapString($a, 0, $n-1);

        return implode(',', $a);
    }

    public function swapString(&$a, $i, $j)
    {
        if ($j > $i) {
            $tmp = $a[$i];
            $a[$i] = $a[$j];
            $a[$j] = $tmp;

            $this->swapString($a, $i+1, $j-1);
        }
    }

    /**
     * Tìm kiếm nhị phân dùng đệ quy
    */
    public function binarySearch()
    {
        $a = [-3,0,1,2,4,5,7,9];
        $target = 1;

        return $this->bSearch($a, 0, count($a), $target);
    }

    public function bSearch($a, $leftIdx, $rightIdx, $target)
    {
        // Stop condition
        if ($leftIdx > $rightIdx) 
            return -1;

        $k = (int) (($leftIdx + $rightIdx) / 2);

        if ($a[$k] == $target) 
            return $k;

        if ($a[$k] < $target) {
            return $this->bSearch($a, $k + 1, $rightIdx, $target);
        } else {
            return $this->bSearch($a, 0, $k - 1, $target);
        }
    }
}
