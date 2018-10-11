package servlet

import javax.servlet.annotation.WebServlet
import javax.servlet.http.HttpServlet
import javax.servlet.http.HttpServletRequest
import javax.servlet.http.HttpServletResponse

@WebServlet("/")
class ControllerServlet : HttpServlet() {
  override fun doGet(req: HttpServletRequest, resp: HttpServletResponse) {
    // here will be sending statics to user
    if (req.requestURI != null && (req.requestURI.endsWith(".png") || req.requestURI.endsWith(".css"))) {
      // send statics here
      resp.writer.write("Send static here with URI: ")
      resp.writer.write(req.requestURI)
    } else {
      resp.contentType = "text/html;charset=UTF-8"
      req.getRequestDispatcher("index.jsp").forward(req, resp)
    }
  }

  override fun doPost(req: HttpServletRequest, resp: HttpServletResponse) {
    // here will be checking input and then calling the AreaCheckServlet
    if (req.requestURI == "/AreaCheckServlet/") {
      req.servletContext.getNamedDispatcher("servlet.AreaCheckServlet").forward(req, resp)
    } else { resp.sendError(404) }
  }
}
