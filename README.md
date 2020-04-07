### 20200415 국회의원선거 입후보자 정보 API

#### 대 선거구 목록 (광역시, 도 단위)
- /regions
> https://api.adrinerdp.co/regions

#### 소 선거구 목록 (시, 군, 구 단위)
- /districts/{regionId}
> https://api.adrinerdp.co/districts/1100

#### 입후보자 목록 및 정보
- /candidates/{regionId}/{districtId}
> https://api.adrinerdp.co/candidates/1100/2110101