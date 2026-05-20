<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>New Contact Form Submission</title>
</head>
<body style="margin:0;padding:0;background:#F0F2F5;font-family:'DM Sans',Arial,sans-serif">
<table width="100%" cellpadding="0" cellspacing="0" style="background:#F0F2F5;padding:40px 20px">
  <tr><td align="center">
    <table width="600" cellpadding="0" cellspacing="0" style="background:#fff;border-radius:12px;overflow:hidden;box-shadow:0 4px 24px rgba(0,0,0,.08);max-width:600px;width:100%">
      <tr>
        <td style="background:#0F2644;padding:28px 36px">
          <table width="100%"><tr>
            <td>
              <div style="display:inline-flex;align-items:center;gap:12px">
                <div style="width:40px;height:40px;background:#C9A84C;border-radius:8px;display:inline-flex;align-items:center;justify-content:center;font-size:1.2rem;font-weight:700;color:#0F2644;vertical-align:middle">SK</div>
                <span style="color:#fff;font-size:1.1rem;font-weight:600;vertical-align:middle;margin-left:10px">Suresh Kumar</span>
              </div>
            </td>
            <td align="right">
              <span style="color:rgba(255,255,255,.5);font-size:.75rem">New Contact Form Message</span>
            </td>
          </tr></table>
        </td>
      </tr>
      <tr>
        <td style="padding:36px">
          <h1 style="font-size:1.3rem;color:#0F2644;margin:0 0 6px">New Message Received</h1>
          <p style="color:#64748B;font-size:.85rem;margin:0 0 28px">Someone has submitted the contact form on sureshkumar.ca</p>

          <table width="100%" cellpadding="0" cellspacing="0">
            <tr>
              <td style="padding:14px 0;border-bottom:1px solid #E2E8F0">
                <span style="font-size:.72rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:#94A3B8">Name</span><br>
                <span style="font-size:.95rem;color:#1C1C1E;font-weight:500;margin-top:4px;display:block">{{ $name }}</span>
              </td>
            </tr>
            <tr>
              <td style="padding:14px 0;border-bottom:1px solid #E2E8F0">
                <span style="font-size:.72rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:#94A3B8">Email</span><br>
                <a href="mailto:{{ $email }}" style="font-size:.95rem;color:#C9A84C;font-weight:500;margin-top:4px;display:block">{{ $email }}</a>
              </td>
            </tr>
            @if(!empty($phone))
            <tr>
              <td style="padding:14px 0;border-bottom:1px solid #E2E8F0">
                <span style="font-size:.72rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:#94A3B8">Phone</span><br>
                <span style="font-size:.95rem;color:#1C1C1E;font-weight:500;margin-top:4px;display:block">{{ $phone }}</span>
              </td>
            </tr>
            @endif
            <tr>
              <td style="padding:14px 0">
                <span style="font-size:.72rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:#94A3B8">Message</span><br>
                <div style="margin-top:10px;background:#F8F6F1;border-radius:8px;padding:16px;border-left:3px solid #C9A84C">
                  <p style="font-size:.9rem;color:#1C1C1E;line-height:1.75;margin:0;white-space:pre-wrap">{{ $message }}</p>
                </div>
              </td>
            </tr>
          </table>

          <div style="margin-top:28px;text-align:center">
            <a href="mailto:{{ $email }}" style="display:inline-block;background:#C9A84C;color:#0F2644;padding:13px 32px;border-radius:7px;font-weight:700;font-size:.88rem;text-decoration:none;letter-spacing:.03em">Reply to {{ $name }}</a>
          </div>
        </td>
      </tr>
      <tr>
        <td style="background:#F8F6F1;padding:20px 36px;border-top:1px solid #E2E8F0">
          <p style="font-size:.72rem;color:#94A3B8;margin:0;text-align:center">This message was submitted via the contact form at <a href="{{ config('app.url') }}" style="color:#C9A84C">{{ config('app.url') }}</a> · {{ now()->format('F j, Y g:i A T') }}</p>
        </td>
      </tr>
    </table>
  </td></tr>
</table>
</body>
</html>
