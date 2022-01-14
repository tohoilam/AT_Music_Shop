
async function getDeliveryInfoForInvoice() {
  try {
    let response = await fetch('pages/checkoutPage/getCheckoutCart.php');
    if (response.status == 200) {
      let data = await response.text();
      $('#invoiceDeliveryItem').html(data);
    }
    else {
      alert('HTTP return status:', response.status);
    }
  }
  catch (error) {
    alert('Fetch checkout cart in invoice resulted in an Error!');
  }
}