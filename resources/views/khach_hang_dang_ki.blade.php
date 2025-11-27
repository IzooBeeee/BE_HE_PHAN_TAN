<!DOCTYPE html>
<html lang="vi" style="padding:0;Margin:0">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="x-apple-disable-message-reformatting">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Kích hoạt tài khoản</title>
  <link href="https://fonts.googleapis.com/css?family=Lato:400,700&display=swap" rel="stylesheet">
</head>
<body style="margin:0;padding:0;background-color:#f4f4f4;font-family:'Lato',Helvetica,Arial,sans-serif;">
  <table width="100%" cellpadding="0" cellspacing="0" role="presentation" style="background:#f4f4f4;">
    <tr>
      <td align="center" style="padding:30px 10px;">

        <!-- Wrapper -->
        <table width="600" cellpadding="0" cellspacing="0" role="presentation" style="background:#ffffff;border-radius:8px;box-shadow:0 4px 10px rgba(0,0,0,0.08);overflow:hidden;">

          <!-- Header -->
          <tr>
            <td align="center" style="background:#ff5722;padding:20px;">
              <img src="../assets/logoFood.png" width="120" alt="Logo" style="display:block;border:0;">
            </td>
          </tr>

          <!-- Hero -->
          <tr>
            <td align="center" style="padding:40px 30px 20px 30px;">
              <h1 style="font-size:26px;line-height:34px;color:#111111;margin:0;font-weight:700;">
                Chào mừng bạn đến với chúng tôi 🎉
              </h1>
              <p style="font-size:16px;color:#555555;line-height:24px;margin:16px 0 0;">
                Tài khoản của bạn đã được tạo thành công. Hãy kích hoạt ngay để bắt đầu trải nghiệm các dịch vụ hấp dẫn.
              </p>
            </td>
          </tr>

          <!-- Body -->
          <tr>
            <td style="padding:20px 30px;">
              <p style="font-size:16px;color:#555555;line-height:24px;margin:0 0 16px;">
                Xin chào <strong>{{ $data['ho_va_ten'] }}</strong>,
              </p>
              <p style="font-size:16px;color:#555555;line-height:24px;margin:0 0 24px;">
                Cảm ơn bạn đã đăng ký tài khoản tại <strong>Website của chúng tôi</strong>.
                Để hoàn tất quá trình đăng ký, vui lòng nhấn nút bên dưới để kích hoạt tài khoản:
              </p>
              <div style="text-align:center;margin:30px 0;">
                <a href="{{ $data['link'] }}" target="_blank"
                  style="display:inline-block;padding:14px 32px;background:#ff5722;color:#ffffff;font-weight:700;
                         font-size:16px;border-radius:6px;text-decoration:none;">
                  🔑 KÍCH HOẠT TÀI KHOẢN
                </a>
              </div>
              <p style="font-size:14px;color:#777777;line-height:22px;margin:0;">
                Nếu nút trên không hoạt động, hãy copy đường dẫn sau và dán vào trình duyệt của bạn:
              </p>
              <p style="font-size:14px;word-break:break-all;margin:8px 0 0;">
                <a href="{{ $data['link'] }}" style="color:#ff5722;text-decoration:none;">{{ $data['link'] }}</a>
              </p>
            </td>
          </tr>

          <!-- Footer -->
          <tr>
            <td style="padding:25px 30px;color:#555555;font-size:15px;line-height:22px;text-align:center;background:#fafafa;">
              <p style="margin:0;">Trân trọng,</p>
              <p style="margin:4px 0 0;font-weight:600;">Đội ngũ Hỗ trợ Khách hàng</p>
            </td>
          </tr>
        </table>

      </td>
    </tr>
  </table>
</body>
</html>
