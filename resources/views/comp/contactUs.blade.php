<div class="ContactUs mb-4" id="contactus">
    <div class="theForm w-75">
        <h2 class="text-success mt-3 mb-5">Kontak Kami</h2>
        <form id="contactForm" name="sentMessage">
            <div class="control-group w-75">
                <div class="form-floating controls pb-2">
                    <input class="form-control shadow rounded-3" type="text" id="name" required="" placeholder="Name">
                    <label class="form-label">Nama</label>
                    <small class="form-text text-danger"></small>
                </div>
            </div>
            <div class="control-group w-75">
                <div class="form-floating controls pb-2">
                    <input class="form-control shadow rounded-3" type="email" id="email" required="" placeholder="Email Address">
                    <label class="form-label">Email</label>
                    <small class="form-text text-danger"></small>
                </div>
            </div>
            <div class="control-group w-75">
                <div class="form-floating controls pb-2">
                    <input class="form-control shadow rounded-3" type="tel" id="phone" required="" placeholder="Phone Number">
                    <label class="form-label">Nomor Telpon</label>
                    <small class="form-text text-danger"></small>
                </div>
            </div>
            <div class="control-group w-75">
                <div class="mb-2 form-floating controls pb-2">
                    <textarea class="form-control shadow rounded-3" id="message" required="" placeholder="Message" style="height: 150px;"></textarea>
                    <label class="form-label">Pesan</label>
                    <small class="form-text text-danger"></small>
                </div>
            </div>
            <div id="success"></div>
            <div>
                <button class="btn btn-success btn-xl w-75 shadow rounded-3" id="sendMessageButton" type="submit">Kirim</button>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('contactForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const phone = document.getElementById('phone').value;
    const message = document.getElementById('message').value;

    const whatsappMessage = `Halo, nama saya ${name}. Email saya adalah ${email}, nomor telpon ${phone}. Pesan: ${message}`;

    const encodedMessage = encodeURIComponent(whatsappMessage);

    const whatsappUrl = `https://wa.me/62895332477245?text=${encodedMessage}`;

    window.open(whatsappUrl, '_blank');
});
</script>
