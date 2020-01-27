<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Adhoc;
use Carbon\Carbon;
use PDF;
use Mail;
use Dompdf\Dompdf;

class AdhocController extends Controller
{
    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
     public $successStatus = 200;
     
    public function store(Request $request)
    {
    
    $this->validate($request,['name'=>'required','gender'=>'required','mobile'=>'required','otp'=>'required','person'=>'required','purpose'=>'required']);  
    $adhoc=Adhoc::create($request->all());
      
     if ($request->has('pic')) {
        $base64=$request->pic;
        $edit=str_after($base64,'data:image/png;base64,');
        // decode base64 data
        $data = base64_decode($edit);
        $randomString = str_random(25);
        //setting image path
        $path = public_path('').'/images/'. "$randomString " . '.png';
        //saving in folder
        file_put_contents($path, $data);
        $adhoc->pic= $path;
        $adhoc->update([]);
            
      } 
      return response()->json(['adhoc'=>$adhoc], $this->successStatus);
    }
  
    public function show(Request $request){
        
         $adhoc = Adhoc::where('created_at', '>=', Carbon::today())
	 ->whereNull('logout')
	 ->get();
        
        return response()->json(['adhoc' => $adhoc], $this->successStatus);

    }
	 public function search($mobile)
    {
	$search = Adhoc::where(function ($query) use ($mobile) 
	{
    		$query->where('mobile' , 'like', $mobile . '%')
          	->orWhere('name', 'like', $mobile .'%' );
	})
	->where('created_at', '>=', Carbon::today())
	->whereNull('logout')
	->get();	
	return response()->json(['search' => $search], $this->successStatus);
	}
    public function edit($id)
    {
       
	$adhoc = Adhoc::find($id);
	$adhoc->logout=Carbon::now();
	$adhoc->save();
        return response()->json(['adhoc' => $adhoc], $this->successStatus);
    }
    public function downloadPDF(Request $request)

    {
        $start =$request->from_date;
	$end =$request->to_date;
	$email= $request->email;
	$adhoc = Adhoc::whereBetween('created_at',[$start,$end])->get();
	$adhoc=['adhoc' => $adhoc];
	$pdf = PDF::loadView('pdfView',$adhoc);
    	 Mail::send(['text'=>null],$adhoc, function($message)use($pdf,$email)
	{
		
		$message->from('support@forevr.in', 'charan');
		$message->to($email);
		$message->attachData($pdf->output(), 'invoice.pdf');	
	});
	echo 'Email was sent!';
     }
     
          public function test(Request $request)

    {
        $start ="2018-02-02 10:56:31";
	$end ="2018-02-22 10:56:31";//$request->from_date;
	// //$request->from_date;$request->from_date;
	$adhoc = Adhoc::whereBetween('created_at',[$start,$end])->get();
	
	
	$pdf = PDF::loadView('pdfView',compact('adhoc'));
	
	return $pdf->download('invoice.pdf');
    	/* Mail::send(['text'=>'pdfView'],$adhoc, function($message)use($pdf )
	{
		
		$message->from('support@forevr.in', 'charan');
		$message->to('charan.gangam9@gmail.com')->subject('Invoice');
		$message->attachData($pdf->output(), 'invoice.pdf');	
	});
	
 	echo 'Email was sent!'; */
    }
     
}
