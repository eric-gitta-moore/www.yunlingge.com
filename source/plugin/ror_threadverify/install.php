<?php
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')){
    exit('Access denied');
}

$plugin_name = 'ror_threadverify';

$sql = <<<EOT

EOT;

runquery($sql);

$auth = 'acd9H88uX2dRLEuhqk1isLKlYjL2STv856cwZ3LBJgOSfQebfm8M0ayWg7mXCu56CoIef07kY3iIpt1J2akLAX7raOkHTr9dh5BrbLIWPj6Kuo3Wct7LqSHsSba2y6QwyHYcQgDro2P+S9JpPCSY3h20FnIOcTNzFpYNRDPt9O7sTsNKVMDaH39aGkeBWrbkvjOOoq8EkY0K0/CS0130SrLiTUGIqOQFMk1BIaTwnf28fIVLJf7OWcTNN17tugaxsd1RPoRNoO9ILHe7U2NkPTFL3yDSVcvyVNee0uafLJPMQ4EyfYjypzyhl+HoMw58TTlBHubUg29RJcpITccC+2ExkD8HRhssbYjqG+M1yiUKFqwrTZZuI85+vRTzNnCE2PBLHPOJD6KDXWtdSHLvnjx6YrWCXk5NMcdwNLYQIxw75oUu1lsqyIBgkOz3sKjnHI/4ZQ2TbBl00XO1IAvw5cBOhemIf0VlbkQ12hhpFD0W7gzkAfmzp0zFWT00GM22fanfMOMz0zLlZN6u90cTVX47We1qRI1dIvdzJKHqmzWUn/SkBKituKM1QmOAmYgriGuMLI+KSK51R9MKbRk0k74jcy5pqadFwA6Nx1cyMvjZR4FosHu/3t77fA54mXvIEgOi9lgAJz730dvvwzBqa9ARo5jtWOhQfW33LHqbVnLgTg0fEcGcSepaEkACGtCJH+mT8VddgJa6whbZ8oE+2meDjbiRFTN/wBBTxWv2jCX3C2bdHKe1N8+LL9zimutzY1becqX9yKI8ohUwLwKGadWK2UgWy6kOcDj1L+QyOoa7rDWkhUJfAJE1xPcP4AZXjCGclw4BqWGRbDI7SaPnhfKQq1tq8H0O2YWpaexTS+Uzt2ipZDvIBkUUSWDOd9757+X50dKkoNG9AqfM0Fpd+GPHkHyh';
C::t('common_syscache')->insert($plugin_name, array('auth'=>$auth));

$finish = true;