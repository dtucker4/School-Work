﻿/// <summary>
/// 2D Space Shooter Example
/// By Bug Games www.Bug-Games.net
/// Programmer: Danar Kayfi - Twitter: @DanarKayfi
/// Special Thanks to Kenney for the CC0 Graphic Assets: www.kenney.nl
/// 
/// This is the EnemyGreen Script:
/// - Enemy Ship Movement/Health/Score
/// - Explosion Trigger
/// 
/// </summary>

using UnityEngine;
using System.Collections;

public class EnemyGreen_Script : MonoBehaviour 
{

	//Public Var
	public float speed;						//Enemy Ship Speed
	public int health;						//Enemy Ship Health
	public GameObject LaserGreenHit;		//LaserGreenHit Prefab
	public GameObject Explosion;			//Explosion Prefab
	public int ScoreValue; 					//How much the Enemy Ship give score after explosion
	public GameObject shot; 				//Fire Prefab
	public Transform shotSpawn;				//Where the Fire Spawn
	public float fireRate = 1F;				//Fire Rate between Shots
    GameObject player;
    //Private Var
    private float nextFire = 4.0F; 			//First fire & Next fire Time
    Transform target;

    // Use this for initialization
    void Start () 
	{
         player = GameObject.FindGameObjectWithTag("Player");

        if (player != null)
        {
            target = player.transform;
        }
        StartCoroutine(spawnTimer(1.0f));
        

    }
    public IEnumerator spawnTimer(float waitTime)
    {
        yield return new WaitForSeconds(1f);
        gameObject.tag = "Enemy";

    }
    // Update is called once per frame
    void Update () 
	{
        if (player != null)
        {
            transform.position = Vector2.MoveTowards(transform.position, target.position, speed * Time.deltaTime);

            Vector2 direction = new Vector2(target.position.x, target.position.y);

            direction.Normalize();
            var angle = Mathf.Atan2(direction.y, direction.x) * Mathf.Rad2Deg;


            //Excute When the Current Time is bigger than the nextFire time
            if (Time.time > nextFire)
            {
                nextFire = Time.time + fireRate;                                 //Increment nextFire time with the current system time + fireRate
                Instantiate(shot, shotSpawn.position, shotSpawn.rotation);      //Instantiate fire shot 
                GetComponent<AudioSource>().Play();                            //Play Fire sound
            }
        }
	}

	//Called when the Trigger entered
	void OnTriggerEnter2D(Collider2D other)
	{
		//Excute if the object tag was equal to one of these
		if(other.tag == "PlayerLaser")
		{
			Instantiate (LaserGreenHit, transform.position , transform.rotation); 		//Instantiate LaserGreenHit 
			Destroy(other.gameObject); 												   //Destroy the Other (PlayerLaser)
			
			//Check the Health if greater than 0
			if(health > 0)
				health--; 																//Decrement Health by 1

			//Check the Health if less or equal 0
			if(health <= 0)
			{
				Instantiate (Explosion, transform.position , transform.rotation); 		//Instantiate Explosion
				SharedValues_Script.score +=ScoreValue; 								//Increment score by ScoreValue
				Destroy(gameObject); 													//Destroy The Object (Enemy Ship)
			}
		}
		
	}
}
