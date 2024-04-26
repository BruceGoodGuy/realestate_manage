@props(['province', 'district', 'ward', 'selector'])
<script defer>
    const loadingElement = `<option value="" disabled class="text-dark option-loading">Đang tải...</option>`,
        provinceElement = document.querySelector('select[name="province"]'),
        districtElement = document.querySelector('select[name="district"]'),
        wardElement = document.querySelector('select[name="ward"]'),
        formElement = document.getElementById('{{$selector}}'),
        addressData = {
            province: '',
            district: '',
            ward: ''
        };
    let oldProvince = "{{ $province }}",
        oldDistrict = "{{ $district }}",
        oldWard = "{{ $ward }}";

    provinceElement.addEventListener('click', populateOptions.bind(null, 'provinces'));
    provinceElement.addEventListener('change', updateDistricts);
    districtElement.addEventListener('click', populateOptions.bind(null, 'districts'));
    districtElement.addEventListener('change', updateWards);
    wardElement.addEventListener('click', populateOptions.bind(null, 'wards'));

    const clickEvent = new Event('click');
    if (oldProvince !== '') {
        provinceElement.dispatchEvent(clickEvent);
        districtElement.removeAttribute('disabled');
    }


    formElement.addEventListener('submit', function(e) {
        e.preventDefault();
        const province = provinceElement.value !== '' ? provinceElement.options[provinceElement.selectedIndex]
            .text : '';
        const district = districtElement.value !== '' ? districtElement.options[districtElement.selectedIndex]
            .text : '';
        const ward = wardElement.value !== '' ? wardElement.options[wardElement.selectedIndex]
            .text : '';
            console.log(234);
        document.querySelector('input[name="province_value"]').value = province;
        document.querySelector('input[name="district_value"]').value = district;
        document.querySelector('input[name="ward_value"]').value = ward;
        this.submit();
    });

    function populateOptions(dataType, event) {
        const targetElement = event.target;
        if (targetElement.options.length > 1) {
            return;
        }
        targetElement.insertAdjacentHTML('beforeend', loadingElement);

        let url = '';
        if (dataType === 'provinces') {
            url = "{{ route('api.public.provices') }}";
        } else if (dataType === 'districts') {
            url = "{{ route('api.public.districts', 'province_code') }}".replace('province_code', provinceElement
                .value === "" ? oldProvince : provinceElement.value);

        } else if (dataType === 'wards') {
            url = "{{ route('api.public.wards', 'district_code') }}".replace('district_code', districtElement.value ===
                "" ? oldDistrict : districtElement.value);
        }

        callAPI(url, function(data) {
            let optionTemplate = '';
            const items = data.data;
            if (dataType === 'provinces') {
                provicesData = data.data;
            }
            items.map(item => {
                let name = item.name,
                    isSelected = false;
                if (dataType === 'provinces') {
                    name = name.replace('Tỉnh ', '').replace('Thành phố ', '');
                    isSelected = oldProvince !== '' && (oldProvince === item.code || oldProvince ===
                        name);
                    if (isSelected) {
                        if (!(/^-?\d*\.?\d+$/.test(oldDistrict))) {
                            oldProvince = item.code;
                        }
                        districtElement.dispatchEvent(clickEvent);
                        wardElement.removeAttribute('disabled');
                    }
                } else if (dataType === 'districts') {
                    isSelected = oldDistrict !== '' && (oldDistrict === item.code || oldDistrict ===
                        item.name);
                    if (isSelected) {
                        if (!(/^-?\d*\.?\d+$/.test(oldDistrict))) {
                            oldDistrict = item.code;
                        }
                        wardElement.dispatchEvent(clickEvent);
                    }
                } else if (dataType === 'wards') {
                    isSelected = oldWard !== '' && (oldWard === item.code || oldWard === item.name);
                }
                optionTemplate +=
                    `<option value="${item.code}" ${isSelected ? 'selected' : ''}  class="text-dark">${name}</option>`;
            });
            targetElement.insertAdjacentHTML('beforeend', optionTemplate);
        }, function() {
            targetElement.querySelector('option.option-loading').remove();
        });
    }

    function updateDistricts(event) {
        const selectValue = event.target.value;
        if (selectValue === '') {
            districtElement.setAttribute('disabled', true);
        } else {
            districtElement.removeAttribute('disabled');
        }
        resetSelectElement(districtElement);
        wardElement.setAttribute('disabled', true);
        resetSelectElement(wardElement);
    }

    function updateWards(event) {
        const selectValue = event.target.value;
        if (selectValue === '') {
            wardElement.setAttribute('disabled', true);
        } else {
            wardElement.removeAttribute('disabled');
        }
        resetSelectElement(wardElement);
    }

    function resetSelectElement(element) {
        if (element.options.length > 1) {
            element.querySelectorAll('option').forEach(option => {
                if (!option.disabled) {
                    option.remove();
                }
            });
            element.value = '';
        }
    }
</script>
