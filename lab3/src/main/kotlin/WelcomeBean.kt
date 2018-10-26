import javax.faces.bean.ManagedBean

class WelcomeBean {
  init {
    println("WelcomeBean instantiated")
  }

  fun getMessage(): String {
    return "I'm alive!"
  }
}