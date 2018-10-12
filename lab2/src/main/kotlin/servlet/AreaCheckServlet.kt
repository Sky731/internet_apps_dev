package servlet

import java.lang.NumberFormatException
import javax.servlet.annotation.WebServlet
import javax.servlet.http.HttpServlet
import javax.servlet.http.HttpServletRequest
import javax.servlet.http.HttpServletResponse
import kotlin.math.sqrt

@WebServlet(name = "AreaCheckServlet")
class AreaCheckServlet : HttpServlet() {
  override fun doPost(req: HttpServletRequest, resp: HttpServletResponse) {
    try {
      val x = req.getParameter("x").toDouble()
      val y = req.getParameter("y").toDouble()
      val r = req.getParameter("r").toDouble()
      if (r <= 0) throw NumberFormatException("Radius can't be less than 0")
      if (checkHit(x, y, r)) {
        resp.writer.write("Yeah, you got it")
      } else {
        resp.writer.write("You've missed :(")
      }
    } catch (e: Exception) {
      e.printStackTrace()
      resp.sendError(400, e.message)
    }
  }

  private fun checkHit(x: Double, y: Double, r: Double) : Boolean {
    if (r <= 0) return false
    if (x in 0.0 .. r/2 && y in 0.0 .. r) return true
    if (x in 0.0 .. r && y in -r .. 0.0 && sqrt(x*x + y*y) <= r) return true
    if (x in -r .. 0.0 && y in -r/2 .. 0.0 && x <= r - y) return true
    return false
  }
}
