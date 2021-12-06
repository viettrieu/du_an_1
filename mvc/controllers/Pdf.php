<?php
use Dompdf\Dompdf;
class Pdf extends Controller{
    public $user;
    public $order;
    public $orderId;
    public $dompdf;
    public $orderModel;
    public function __construct()
    {
        // print_r($_POST);
        $this->orderId = explode('/',$_GET['url'])[1] ? explode('/',$_GET['url'])[1] : null;
        $this->user= $this->model('UserModel');
        $this->order = $this->model('PdfModel');
        $this->orderModel = $this->model('OrderModel');
    }
    public function SayHi(){
        $order = $this->orderModel->GetOrderById($this->orderId);
        $user = $this->user->FindById($order['userId']);
        $isExport = isset($_GET['isExport']);
        if(isset($_POST)){
            if(isset($_POST['pdf'])){
                $this->dompdf = new Dompdf();
                $this->dompdf->set_option('enable_remote', TRUE);
                $this->dompdf->loadHtmlFile('http://localhost/du_an_1' . "/pdf/" . $this->orderId . '?isExport=true','UTF-8');
                $this->dompdf->setPaper('A4', 'portrait');
                $this->dompdf->render();
                $this->dompdf->stream();
            }
        }
        $this->view('pdf',[
            "Title"=>'Pdf',
            "user"=>$user,
            "order"=>$this->order->countProduct($this->orderId),
            "isExport"=>$isExport
        ]);
    }
}