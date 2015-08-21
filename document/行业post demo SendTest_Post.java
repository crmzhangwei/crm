

import java.io.IOException;

import org.apache.commons.httpclient.HttpClient;
import org.apache.commons.httpclient.HttpStatus;
import org.apache.commons.httpclient.NameValuePair;
import org.apache.commons.httpclient.methods.PostMethod;

public class SendTest_Post{
	public static void main(String[] args) throws IOException {

		HttpClient httpClient = new HttpClient();

		String url = "http://sms.10690221.com/hy/";
		String uid = "1234";
		String auth = new MD5().getMD5ofStr("企业代码密码");
		String mobile = "136123456787";
                String content=java.net.URLEncoder.encode("测试消息", "gbk");
		PostMethod postMethod = new PostMethod(url);
		
		NameValuePair[] data = {
					new NameValuePair("uid", uid),
					new NameValuePair("auth", auth),
					new NameValuePair("mobile", mobile),
					new NameValuePair("expid", "0"),
					new NameValuePair("msg",content ) };
		postMethod.setRequestBody(data);
		int statusCode = httpClient.executeMethod(postMethod);
			
		if (statusCode == HttpStatus.SC_OK) {
			String sms = postMethod.getResponseBodyAsString();
			System.out.println("result:" + sms);
		}
		System.out.println("statusCode="+statusCode);	 
	}
}
