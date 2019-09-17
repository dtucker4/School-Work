/// <summary>
/// 2D Space Shooter Example
/// By Bug Games www.Bug-Games.net
/// Programmer: Danar Kayfi - Twitter: @DanarKayfi
/// Special Thanks to Kenney for the CC0 Graphic Assets: www.kenney.nl
/// 
/// This is the Player Ship Script:
/// - Player Ship Movement
/// - Fire Control
/// - Screen Boundary Control
/// - Explosion/Game Over Trigger
/// 
/// </summary>

using UnityEngine;
using System.Collections;

[System.Serializable]
public class Boundary 
{
	public float xMin, xMax, yMin, yMax; //Screen Boundary dimentions
}

public class Player_Script : MonoBehaviour 
{
	//Public Var
	public float speed; 			//Player Ship Speed
	public Boundary boundary; 		//make an Object from Class Boundary
	public GameObject shot;			//Fire Prefab
	public Transform shotSpawn;		//Where the Fire Spawn
	public float fireRate = 0.5F;	//Fire Rate between Shots
	public GameObject Explosion;	//Explosion Prefab
    public float playerSpeed;
    public Rigidbody2D player;
    //Private Var
    private float nextFire = 0.0F;	//First fire & Next fire Time
    public float shotSpeed = 500f;

    // Update is called once per frame
    void Update () 
	{

        if (Input.GetMouseButtonDown(0))
        {
            if (Time.time >= nextFire)
            {
                nextFire = Time.time + fireRate;
                Invoke("FirePlayerBullet", 0f);
                GetComponent<AudioSource>().Play();
            }
        }
        
      
	}

    // FixedUpdate is called one per specific time

    void FixedUpdate ()
	{
        Invoke("MovePlayer", 0f);


      

    }
    void MovePlayer()
    {

      //player to face mouse
        Vector3 mousePos = Camera.main.ScreenToWorldPoint(Input.mousePosition);
        transform.rotation = Quaternion.LookRotation(Vector3.forward, mousePos - transform.position);

        //get player inputs
        float horizontal = Input.GetAxis("Horizontal");
        float vertical = Input.GetAxis("Vertical");

        //create vector for movement
        Vector2 move = new Vector2(horizontal , vertical);

        GetComponent<Rigidbody2D>().position = new Vector2
           (
               Mathf.Clamp(GetComponent<Rigidbody2D>().position.x, boundary.xMin, boundary.xMax),  //X
               Mathf.Clamp(GetComponent<Rigidbody2D>().position.y, boundary.yMin, boundary.yMax)    //Y
           );
        if (move.sqrMagnitude < .1)
        {
            //transform.position += (move*speed*Time.deltaTime);
            return;
        }
        else
        {
            player.velocity = move * playerSpeed;
            // player.AddForce(move * playerSpeed);

        }

       
    }





    void FirePlayerBullet()
    {

        Vector2 target = Camera.main.ScreenToWorldPoint(new Vector2(Input.mousePosition.x, Input.mousePosition.y));
      
        Vector2 myPos = new Vector2(transform.position.x, transform.position.y);
        Vector2 direction = target - myPos;
        direction.Normalize();
  
        GameObject shotClone;
        shotClone = Instantiate(shot, shotSpawn.position, Quaternion.identity) as GameObject;

        
        shotClone.GetComponent<Rigidbody2D>().AddForce(direction * shotSpeed);
        var angle = Mathf.Atan2(direction.y, direction.x) * Mathf.Rad2Deg;

        shotClone.transform.rotation = Quaternion.AngleAxis(angle, Vector3.forward);
        
    }



    //Called when the Trigger entered
    void OnTriggerEnter2D(Collider2D other)
	{
		//Excute if the object tag was equal to one of these
		if(other.tag == "Enemy" || other.tag == "Asteroid" || other.tag == "EnemyShot") 
		{
            Debug.Log("test");
			Instantiate (Explosion, transform.position , transform.rotation); 				//Instantiate Explosion
			SharedValues_Script.gameover = true; 											//Trigger That its a GameOver
			Destroy(gameObject); 															//Destroy Player Ship Object
		}
	}
}
