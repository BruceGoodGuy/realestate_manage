<script type="text/javascript">
    const referralElement = document.querySelector('input[name="referral_code"]'),
        btnReferral = document.getElementById('btn-check-referral'),
        referralInformElement = document.querySelector('.referral-inform');

    btnReferral.addEventListener('click', checkReferralCode);

    function checkReferralCode(e) {
        const referralCode = referralElement.value.trim();
        if (referralCode.length === 0 || referralCode.length < 10 || referralCode.length > 40) {
            referralInformElement.classList.remove('d-none');
            referralInformElement.classList.add('text-danger');
            e.target.disabled = false;
            referralInformElement.querySelector('span').innerText = 'Mã giới thiệu không hợp lệ.'
            return;
        }
        referralInformElement.classList.add('d-none');
        e.target.disabled = true;

        const url = '{{ route('ajax.checkreferral') }}?' + new URLSearchParams({
            code: referralCode,
        });

        callAPI(url, function(data) {
            if (data.success) {
                referralInformElement.classList.remove('text-danger');
                referralInformElement.classList.add('text-success');
                referralInformElement.querySelector('span').innerText =
                    `Mã giới thiệu hợp lệ. (${data.data.firstname} ${data.data.lastname})`;
            } else {
                referralInformElement.classList.add('text-danger');
                referralInformElement.classList.remove('text-success');
                referralInformElement.querySelector('span').innerText =
                    `${data.message} | Nếu tiếp tục, bạn vẫn có thể tạo khách hàng này mà không cần mã giới thiệu.`
            }
            referralInformElement.classList.remove('d-none');
            e.target.disabled = false;
        });
    }
</script>
